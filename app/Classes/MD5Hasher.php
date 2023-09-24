<?php
namespace App\Classes;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use App\User;

class MD5Hasher extends BcryptHasher
{
	public function check($value, $hashedValue, array $options = array())
   	{
   		$email = request()->input('username');
      if(empty($email)){
        $email = request()->input('email');
      }
   		if(empty($email) && !empty(request()->input('data')['email'])){
   			$email = request()->input('data')['email'];
   		}
      if(empty($email) && !empty(Auth::user()->username)){
        $email = Auth::user()->username;
      }
   		$value = $value.strtolower($email).$value[2];
   		return (md5($value) === $hashedValue ? true : false);
		//$user = User::wherePassword(md5($value))->first();
		//return $user ? true : false;
    }
}