<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Mail\Forgotpassword;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Zone;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Password;
use Response;

class UserController extends Controller
{
    /* Login */
    public function login(Request $request){
    	$rules = [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	];
    	if($this->ApiValidator($request->all(), $rules)) {
    		if(Auth::attempt(['username' => $request->email, 'password' => $request->password, 'user_type' => 'normal'])){
                $user = Auth::user();
                if($user->active){
                    $res_user = $user->contact;
                    $res_user->birthsdate=  date('Y-m-d', strtotime($user->birthsdate));
                    $res_user->country = Country::where('id_country', $res_user->key_country)->value('name');
                    $this->response['data']['user'] = $res_user;
                    $this->response['data']['token'] = $user->createToken('XXSIM')->accessToken;
                    $this->status = $this->statusArr['success'];    
                }
                else{
                    $this->response['message'] = trans('in_active');
                }
	    	}else{
	    		$this->response['message'] = "Invalid Email or Password";
	    		$this->status = $this->statusArr['unauthorised'];
	    	}
    	}
    	return $this->return_response();
    }

    /* Registration */
    public function register(Request $request){
    	$rules = [
    		'title' => 'required',
            'address' => 'required',
            'firstname' => 'required',
            // 'zip' => 'required',
            'lastname' => 'required',
            'city' => 'required',
            'birthsdate' => 'required',
            'country' => 'required',
            'document' => 'required',
            'document_no' => 'required',
            'phone' => 'required',
            // 'mobile' => 'required',
            // 'business_name' => 'required',
            'email' => 'required|email|unique:user,username',
            'password' => 'required',
    	];

    	if($this->ApiValidator($request->all(), $rules)){
    		try{
                $password = $request->password.strtolower($request->email).$request->password[2];

                $user_data = [
                    'key_user_sex' => 3,
                    'key_language' => 2,
                    'username' => $request->email,
                    'password' => md5($password),
                    'birthsdate' => date('Y-m-d H:i:s', strtotime($request->birthsdate)),
                    'key_user_status' => 2
                ];

                $user = User::create($user_data);

                $country_id = Country::where('name', $request->country)->value('id_country');
                $contact_data = [
                    'key_user' => $user->id_user,
                    'key_user_contact_type' => 1,
                    'business_name' => (!empty($request->business_name) ? $request->business_name : NULL),
                    'title' => $request->title,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'key_country' => $country_id,
                    'city' => $request->city,
                    'zip' => (!empty($request->zip) ? $request->zip : NULL),
                    'address' => $request->address,
                    'mobile' => (!empty($request->mobile) ? $request->mobile : NULL),
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'document' => $request->document,
                    'document_no' => $request->document_no,
                ];

                $contact = Contact::create($contact_data);

                $res_user = $user->contact;
                $res_user->birthsdate=  date('Y-m-d', strtotime($user->birthsdate));
                $res_user->country = Country::where('id_country', $res_user->key_country)->value('name');
                $this->response['data']['user'] = $res_user;

                $this->response['data']['token'] = $user->createToken('XXSIM')->accessToken;
	    		$this->status = $this->statusArr['success'];
	    		// $this->response['message'] = "You have been succesfully registered ! Login Now";
    		}catch(Exception $ex){
    			$this->status   = $this->statusArr['something_wrong'];
    			$this->response['message']  = "Something went wrong, Please try again";
    			return $this->return_response();
    		}
    	}
    	
    	return $this->return_response();
    }

    /* Forgot Password */
    public function forgotPassword(Request $request){
        $rules = [
            'email'=>'required|email'
        ];

        if($this->ApiValidator($request->all(), $rules)){
            try{
                $user   = User::where([['active', 1], ['username', $request->email],['user_type','normal']])->firstOrFail();
                $token  = Str::random(60);
                $user->remember_token = $token;
                $user->save();
                $url = url(env('APP_URL').route('password.reset', $token, false));
                Mail::to($request->email)->send(new Forgotpassword(['url' => $url]));

                $this->status   = $this->statusArr['success'];
                $this->response['message']  = "Please check your email to reset your password";

            }catch(ModelNotFoundException $ex){
                $this->status = $this->statusArr['not_found'];
                $this->response['message']= "User not found with this email";
                return $this->return_response();
            }
        }
        return $this->return_response();
    }

    /* Logout */
    public function logout(Request $request){
        $request->user()->token()->revoke();

        $this->status = $this->statusArr['success'];
        $this->response['message'] = "Successfully logged out";
        return $this->return_response();
    }

    /* Get Profile */
    public function profile(){
        $user = Auth::user();
        if(!empty($user)){
            $this->status = $this->statusArr['success'];
            $this->response['message'] = trans('api.success');
    	    $res_user = $user->contact;
            $res_user->birthsdate=  date('Y-m-d', strtotime($user->birthsdate));
            $res_user->country = Country::where('id_country', $res_user->key_country)->value('name');
            $this->response['data']['user'] = $res_user;
        }
    	return $this->return_response();
    }

    /* Change Password */
    public function changePassword(Request $request){
        $rules = [
            'old_password'=>'required|min:6',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required|min:6'
        ];

        if($this->ApiValidator($request->all(), $rules)){
            if($request->old_password == $request->password){
                $this->response['message'] = "New password and Current Password must be different";
            }
            else{
                $user = Auth::user();
                if (Hash::check($request->old_password, $user->password)) {
                    //Change the password
                    $email = Auth::user()->username;
                    $value = $request->password.strtolower($email).$request->password[2];
                    $user->password = md5($value);
                    $user->save();

                    $this->response['message'] = "Password changed succesfully";
                    $this->status = $this->statusArr['success'];

                }else{
                    $this->response['message'] = "Old password doesn't match";
                }
            }
        }

        return $this->return_response();
    }

    /* Edit Profile */
    public function editProfile(Request $request){
        $user= Auth::user();

        $rules = [
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            // 'phone' => 'required',
            // 'mobile' => 'required',
            // 'business_name' => 'required',
            // 'email' => 'required|email|unique:user,username,'.$user->id_user.',id_user',
        ];
        
        if($this->ApiValidator($request->all(),$rules)){

            $contact_data = [
                'title' => $request->title,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                // 'email' => $request->email,
            ];
            if(!empty($request->phone)){
                $contact_data['phone'] = $request->phone;
            }
            if(!empty($request->mobile)){
                $contact_data['mobile'] = $request->mobile;
            }
            if(!empty($request->business_name)){
                $contact_data['business_name'] = $request->business_name;
            }

            if($user->save()){
                Contact::where('key_user', Auth::id())->update($contact_data);
                $this->status = $this->statusArr['success'];   
                $this->response['message'] = trans('api.edit_profile');
                $res_user = $user->contact;
                $res_user->birthsdate=  date('Y-m-d', strtotime($user->birthsdate));
                $res_user->country = Country::where('id_country', $res_user->key_country)->value('name');
                $this->response['data']['user'] = $res_user;
            }           
        }
        return $this->return_response();  
    }

    /* Edit ProfileImage */
    public function editPhoto(Request $request){
        $user= Auth::user();

        $rules = [
            'profile_image' => 'sometimes|image|mimes:jpg,png,jpeg',
        ];
        
        if($this->ApiValidator($request->all(),$rules)){
            if ($request->hasFile('profile_image')){
                Storage::delete($user->profile_image);
                $user->profile_image = $request->file('profile_image')->store('users');
            }

            if($user->save()){
                $user->group = $user->group()->first();
                $user->profile_image_zoom = checkImage(4,$user->profile_image);
                $user->profile_image = checkImage(3,$user->profile_image);
                $this->status = $this->statusArr['success'];   
                $this->response['message'] = trans('api.edit_profile');
                $this->response['data']['user'] = $user;
            }           
        }
        return $this->return_response(); 
    }

    /* Get Country List */
    public function get_countries(Request $request){
        $this->status = $this->statusArr['success'];   
        $this->response['message'] = trans('api.list', ['entity' => 'countries']);
        $this->response['data'] = Country::orderBy('name')->get();
        return $this->return_response();
    }

    public function get_cards(Request $request){
        $this->status = $this->statusArr['success'];   
        $this->response['message'] = trans('api.list', ['entity' => 'cards']);
        $this->response['data'] = Auth::user()->cards;
        return $this->return_response();
    }

    public function get_zones(Request $request){
        $zones = Zone::all();
        $zone_list = [];
        foreach ($zones as $zone) {
            $zone_list[] = ['id' => $zone->id, 'countries' => explode(',', $zone->countries)];
        }
        $this->status = $this->statusArr['success'];   
        $this->response['message'] = trans('api.list', ['entity' => 'zones']);
        $this->response['data'] = $zone_list;
        return $this->return_response();
    }

    public function card_api_call(Request $request)
    {
        $result = file_get_contents($request->url);
        return $result;
    }
}

/*
 * URL : http://192.168.10.121:8888/laravel/laravel-basic/api/v1/login
 * from-data : parameters
 * Accept:application/json
 * Authorization:Bearer token
 */