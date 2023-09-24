<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\User;
use App\Models\Country;
use App\Models\Contact;

use App\Mail\VerifyAccount;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/simple';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $countries = Country::orderBy('name')->get();
        return view('auth.register', ['countries' => $countries]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
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

        return $user;

        /*return User::create([
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
    }

    public function confirm($activation_code)
    {        
        $user = User::whereActivationCode($activation_code)->first();

        if (!$user){   
            flash('Invalid activation code.')->error();
            return redirect('login');
        }else{
            $user->active = 1;
            $user->activation_code = null;
            $user->save();
            flash('You have successfully verified your account.')->success();
            return redirect('login');
        }
        
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        flash('You have successfully registered, please verify your email address.')->success();

        // $this->guard()->login($user);
        // 
        return redirect()->route('login');

        // return $this->registered($request, $user)
                        // ?: redirect($this->redirectPath());
    }
}
