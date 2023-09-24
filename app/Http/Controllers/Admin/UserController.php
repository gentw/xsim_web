<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Admin;
use App\User;
use App\Models\National_number;

class UserController extends Controller
{
	/********* Manage Password Change **************/
    public function showChangePassword(){
		return view('admin.pages.change_password');
	}

    public function changePassword(Request $request){
    	$rules = [
    		'current_password'=>'required|min:6',
    		'password'=>'required|min:6|confirmed',
    	];
    	$this->validateForm($request->all(), $rules);

        $value = $request->current_password.strtolower(Auth::user()->email).$request->current_password[2];
        if(md5($value) === Auth::user()->password){
            $value = $request->password.strtolower(Auth::user()->email).$request->password[2];
            if(md5($value) !== Auth::user()->password){
                $user = Auth::user();
                $user->password = md5($value);
                $user->save();
                flash('Password changed successfully.')->success();
            }else{
                flash('Current password and new password must not be same.')->error();
            }
    	}else{
            redirect()->back()->withErrors(['current_password'=>"The current password is not matching with records."]);
    	}
    	return redirect()->route('admin.changepass');
    }

    public function checkOldPassword(Request $request){
        if(Hash::check($request->current_password, Auth::user()->password)){
            return "true";
        }else{
            return "false";
        }
    }

    /************** Check Unique Mail Id ****************/
    public function checkUniqueEmail(Request $request){
        $user = User::where('username', $request->email)->first();
        if($user)
            return "false";
        else
            return "true";
    }

    public function checkUniqueAdminEmail(Request $request){
        $user = Admin::where('id' , '!=', $request->id)->where('email', $request->email)->first();
        if($user)
            return "false";
        else
            return "true";
    }

    public function checkUniqueEmailOtherthanMe(Request $request){
        $user = User::where('id' , '!=', $request->id)->where('email', $request->email)->first();
        if($user)
            return "false";
        else
            return "true";
    }


    public function showProfile(){
        $user = Auth::user();       
        return view('admin.pages.edit_profile',compact('user'))->with('headTitle', 'My Profile');
    }

    public function editProfile(Request $request){
        $user = Auth::user();
        
        $rules = [
            'name' => 'required|max:50',
            'email' => ['required', 'max:150', Rule::unique('admins')->ignore($user->id)],
            'contact_no' => 'required|max:14|min:10',
            'profile_photo' => 'sometimes|image|mimes:jpeg,jpg,png',
            'password' => 'required',
        ];

        $this->validateForm($request->all(), $rules);

        $value = $request->password.strtolower($user->email).$request->password[2];
        if(md5($value) !== $user->password){
            flash('The password is not matching with records.')->error();
            return back()->withInputs($request->all());
        }

        if ($request->hasFile('profile_photo'))
            $user->profile_image = $request->file('profile_photo')->store('users');

        if($user->email != $request->email)
           $user->password = md5($request->password.strtolower($request->email).$request->password[2]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact_no = $request->contact_no;

        $user->save();
        flash('Profile changed successfully.')->success();
        return redirect()->route('admin.profile.show');
    }

    public function national_numbers(Request $request){
        $content  = ['status' => 204, 'message' => "something went wrong"];
        if(!empty($request->country)){
            $content['numbers'] = National_number::where('country', 'like', $request->country)->where('allocated', 0)->get();
            $content['status'] = 200;
            $content['message'] = "Success";
        }
        else{
            $content['message'] = "Country not found.";
        }
        return response()->json($content);
    }
}
