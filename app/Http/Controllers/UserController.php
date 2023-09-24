<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccount;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\CardType;
use App\Models\Usedcoupon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;

class UserController extends Controller
{
    public function check_captcha(Request $request)
    {   
        parse_str($request->data, $form_data);

        $content  = ['status' => 204, 'message' => "something went wrong"];

        if(!empty($form_data['captcha'])){
            session_start();
            if(strtolower($form_data['captcha']) == strtolower($_SESSION['captcha'])){
                $content['status'] = 200;
                $content['message'] = 'Successfully matched captcha.';
            }
            else{
                $content['message'] = 'Security code not matched.';
            }
        }

        /*if(!empty($form_data['g-recaptcha-response'])){
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array(
              'secret' => '6LdDrlgUAAAAAHpyFbCKFT70Jd94lbDrm_L4G5xQ',
              'response' => $form_data['g-recaptcha-response']
            );
            $options = array(
              'http' => array (
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                              "Content-Length: ".strlen(http_build_query($data))."\r\n".
                              "User-Agent:MyAgent/1.0\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
              )
            );
            $context  = stream_context_create($options);
            $verify = file_get_contents($url, false, $context);
            $captcha_success=json_decode($verify);

            // print_r($captcha_success);
            // exit;
            if ($captcha_success->success==true) {
                $content['status'] = 200;
                $content['message'] = 'Successfully matched captcha.';
            }
            else{
                $content['message'] = 'Security code not matched.';
            }
        }
        else{
            $content['message'] = 'Security code not matched.';
        }*/

        /*if(captcha_check($request->data)){
            $content['status'] = 200;
            $content['message'] = 'Successfully matched captcha.';
        }
        else{
            $content['message'] = 'Security code not matched.';   
        }*/
        return response()->json($content);
    }

    public function check_login(Request $request)
    {
        $content  = ['status' => 204, 'message' => "something went wrong"];
        $data = $request->data;
        if(!empty($data['email'])){
            if(!empty($data['password'])){
                if (Auth::attempt(['username'=>$data['email'],'password'=>$data['password'],'user_type'=>'normal'])) {
                    if (Auth::user()->active == 0) {
                        Auth::logout();
                        $content['message'] = "Your account is not actived.";
                    }
                    else{
                        $content['status'] = 200;
                        $content['message'] = "You are successfully Login to your account.";
                    }
                }
                else{
                    $content['message'] = "Invalid Username or password.";
                }
            }
            else{
                $content['message'] = "The password field is required.";    
            }
        }
        else{
            $content['message'] = "The email field is required.";
        }
        return response()->json($content);
    }

    public function check_registration(Request $request)
    {
        $content  = ['status' => 204, 'message' => "something went wrong"];

        $data = [];
        parse_str($request->data, $data);

        $validator = Validator::make($data, [
            'title' => 'required|string|max:4',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            // 'zip_code' => 'numeric',
            'surname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'dob' => 'required',
            'country' => 'required|string|max:255',
            // 'currency' => 'required|string|max:255',
            'document' => 'required|string|max:255',
            'document_no' => 'required|string|max:255',
            'phone' => 'required|numeric',
            // 'mobile' => 'required|numeric',
            // 'company' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:user,username',
            'password' => 'required|string|confirmed|min:6',
            // 'location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $r_message  = '';
            foreach($errors->messages() as $key => $message){
                $r_message .= $message[0] . '<br>';
            }

            $content['status'] = 422;
            $content['message'] = $r_message;
        }
        else {
            $password = $data['password'].strtolower($data['email']).$data['password'][2];
            $activation_code = str_random(30);

            $user_data = [
                'key_user_sex' => 3,
                'key_language' => 2,
                'username' => $data['email'],
                'password' => md5($password),
                'birthsdate' => date('Y-m-d H:i:s', strtotime($data['dob'])),
                'key_user_status' => 2,
                'active' => 0,
                'activation_code' => $activation_code
            ];

            $user = User::create($user_data);

            $contact_data = [
                'key_user' => $user->id_user,
                'key_user_contact_type' => 1,
                'business_name' => !empty($data['company']) ? $data['company'] : NULL,
                'title' => $data['title'],
                'firstname' => $data['name'],
                'lastname' => $data['surname'],
                'key_country' => $data['country'],
                'city' => $data['city'],
                'zip' => !empty($data['zip_code']) ? $data['zip_code'] : NULL,
                'address' => $data['address'],
                'mobile' => !empty($data['mobile']) ? $data['mobile'] : NULL,
                'phone' => $data['phone'],
                'email' => $data['email']
            ];

            $contact = Contact::create($contact_data);
            
            Mail::to($data['email'])->send(new VerifyAccount(['activation_code' => $activation_code,'name' => $data['name'], 'username' => $data['email']]));
            flash('You have successfully registered, please verify your email address.')->success();

            /*$user = User::create([
                'title' => $data['title'],
                'address' => $data['address'],
                'name' => $data['name'],
                'zip_code' => $data['zip_code'],
                'surname' => $data['surname'],
                'city' => $data['city'],
                'dob' => $data['dob'],
                'country' => $data['country'],
                'currency' => $data['currency'],
                'document' => $data['document'],
                'document_no' => $data['document_no'],
                'phone' => $data['phone'],
                'mobile' => $data['mobile'],
                'company' => $data['company'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                // 'location' => $data['location'],
            ]);*/
            Auth::login($user);
            $content['status'] = 200;
            $content['message'] = "You are successfully registered.";
        }
        return response()->json($content);
    }

    /**
     * Check email is unique or not.
     * 
     * @param  Request $request
     * @return string
     */
    public function checkUniqueEmail(Request $request){
        $user = User::where('username', $request->email)->first();
        if($user)
            return "false";
        else
            return "true";
    }

    /**
     * Check email is unique or not excepts perticular user.
     * 
     * @param  Request $request
     * @return string
     */
    public function checkUniqueEmailOtherthanMe(Request $request){
        $user = User::where('id_user' , '!=', $request->id)->where('username', $request->email)->first();
        if($user)
            return "false";
        else
            return "true";
    }

    public function apply_coupon(Request $request)
    {
        $content  = ['status' => 204, 'message' => "something went wrong"];
        
        $data = $request->data;
        if(!empty($data['coupon'])){           
            $coupon=Coupon::where(['title'=>$data['coupon']])
                            ->where('start_date','<=',date("Y-m-d"))
                            ->where('end_date','>=',date("Y-m-d"))
                            ->first(); 
            if ($coupon) {
                $usedcoupon=Usedcoupon::where(['user_id'=>Auth::id(),'coupon_id'=>$coupon->id])->first(); 
                if ($usedcoupon) {                    
                    $content['message'] = "Coupon expired.";                
                }else{

                    $dis_per = (int)$coupon->discount;
                    $min_total = (int)$coupon->min_order_amount;
                    $sim_amount = (int)$data['sim_amount'];

                    // card specific discount
                    if((int)($coupon->card_type_id)>0){
                        $card_type = $coupon->card_type_id;
                        
                        if($total=$this->card_valid($coupon,$data)) {
                            if($total >= $min_total){
                                $discount_amount = $total*($dis_per/100);
                                $coupon['discount_amount'] = round($discount_amount,0) ;
                                $coupon['discount_percentage'] = round($dis_per,0) ;
                                $content['status'] = 200;
                                $content['coupon'] = $coupon;
                                $content['card_type'] = $coupon->card_type->type_name;
                                $content['message'] = "Coupon applied with ".$dis_per."% discount to SIM type - ".$card_type.".";    
                            }else{
                                $content['message'] = "Total amount  for SIM type - ".$card_type." should be atleast €".$min_total;                            
                            }
                        }else{
                            $content['message'] = "This Coupon requires SIM type - ".$card_type ." to be included.";    
                        }
                    
                    }else{                        

                        if($sim_amount >= $min_total ){
                            $discount_amount = $sim_amount*($dis_per/100);
                            $coupon['discount_amount'] = round($discount_amount,0) ;
                            $coupon['discount_percentage'] = round($dis_per,0) ;
                            $content['status'] = 200;
                            $content['coupon'] = $coupon;
                            $content['message'] = "Coupon applied with ".$dis_per."% discount.";    
                        }else{
                            $content['message'] = "Total amount should be atleast €".$min_total.".";                            
                        }
                    }
                }
            }
            else{
                $content['message'] = "Invalid Coupon.";
            }            
        }
        else{
            $content['message'] = "The coupon field is required.";
        }
        return response()->json($content);
    }

    function card_valid($coupon,$data){
        $total = 0;
        $selected_card = "";
        
        switch ($coupon->card_type_id) {
            case 1:
                if($data['qty_regular']<=0)
                    return false;
                else{
                    $total =  12 * (int)$data['qty_regular'];                                         
                }
                break;
            case 2:
                if($data['qty_32']<=0)
                    return false;
                else{
                    $total =  32 * (int)$data['qty_32'];                     
                }
                break;
            case 3:
                if($data['qty_50']<=0)
                    return false;
                else{
                    $total =  50 * (int)$data['qty_50'];                     
                }
                break;
        }

        return $total;
    }

    public function used_coupon(Request $request)
    {
        $usedcoupon = new Usedcoupon;
        $usedcoupon->user_id=Auth::id();
        $usedcoupon->coupon_id=$request->coupon_id;
        $usedcoupon->save();
        return 1;
    }
}