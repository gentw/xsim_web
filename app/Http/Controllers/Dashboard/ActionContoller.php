<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use App\Models\Card;
use App\Models\Referral;
use App\Models\National_number;
use App\Models\Gprs_package;
use App\Models\Zone;
use App\Models\Group;
use App\Models\Contact;
use App\User;

use App\Mail\AddCard;
use App\Mail\Referral as Referral_mail;

class ActionContoller extends CardApiController
{
    
    /**
     * [user_add_card description]
     * @return [type] [description]
     */
    public function add_card(Request $request){
        $rules = [
            'card_number' => 'required',
        ];

        $this->validateForm($request->all(),$rules);

        $card = Card::where(['card_number' => $request->card_number, 'user_id' => Auth::id()])->active()->first();

        if(empty($card)){
            $data = ['api_name'=> 'get_balance', 'card'=> $request->card_number];
            $response = $this->card_api($request, $data);

            if($response['status'] == 200){
                $otp = $this->get_unique_otp();
                Mail::to(Auth::user()->username)->send(new AddCard(['name' => Auth::user()->contact->firstname, 'activation_code' => $otp]));
                $data = ['api_name'=> 'sms', 'anum'=> $request->card_number, 'bnum'=> $request->card_number, 'msg'=> 'Activation code is ' . $otp];
                $response = $this->card_api($request, $data);

                if($response['status'] == 200){
                    Card::create([
                        'user_id' => Auth::id(),
                        'card_number' => $request->card_number,
                        'verification_code' => $otp,
                    ]);

                    flash('Activation code successfully sent to your device.')->success();
                    return view('pages.dashboard.check_otp', ['card_number' => $request->card_number]);
                }
                else{
                    flash('something went wrong.')->error();
                    return back()->withInput($request->all());
                }
            }
            else{
            	flash($response['message'])->error();
            	return back()->withInput($request->all());
            }
        }
        else{
            flash('This card is already added into your account')->error();
            /*if($card->user_id == Auth::id()){
                flash('This card is already added into your account')->error();
            }
            else{
                flash('This card is already added into another account')->error();   
            }*/
            return back()->withInput($request->all());
        }
    }

    public function check_card(Request $request){
        $rules = [
            'card_number' => 'required',
            'activation_code' => 'required'
        ];

        $this->validateForm($request->all(),$rules);

        $card = Card::where(['card_number' => $request->card_number, 'user_id' => Auth::id()])->latest()->first();

        if(!$card->active){
           if($card->verification_code == $request->activation_code){
                if($card->user_id == Auth::id()){
                    $card->active = 1;
                    $card->card_status = 1;
                    $card->verification_code = NULL;
                    if($card->save()){
                        Card::where(['card_number' => $request->card_number, 'active' => 0])->delete();
                        /* Active Card */
                        $data = ['api_name'=> 'card_status', 'card'=> $request->card_number, 'block' => 'f'];
                        $response = $this->card_api($request, $data);
                        /* Active GPRS Service */
                        $data = ['api_name'=> 'gprs_service_status', 'card'=> $request->card_number, 'block' => 'f'];
                        $response = $this->card_api($request, $data);
                        /* Get Group Info */
                        $data = ['api_name'=> 'get_card_group_info', 'card'=> $request->card_number];
                        $response = $this->card_api($request, $data);
                        if(empty($response['type'])){
                            $result_card = json_decode($response['result'])->card;
                            $card_balance = (!empty($result_card->card_balance)) ? $result_card->card_balance : NULL;
                            $corp_maxlimit = (!empty($result_card->corp_maxlimit)) ? $result_card->corp_maxlimit : NULL;
                            $corp_minlimit = (!empty($result_card->corp_minlimit)) ? $result_card->corp_minlimit : NULL;
                            $corp_transaction = (!empty($result_card->corp_transaction)) ? $result_card->corp_transaction : NULL;
                            $corp_enabled = (!empty($result_card->corp_enabled) && $result_card->corp_enabled == 'yes') ? 1 : 0;

                            if(!empty($result_card->corp_group)){
                                $corp_group = Group::where('group_id', $result_card->corp_group)->value('id');
                            }

                            if(!empty($corp_group)){
                                Card::where('id', $card->id)->update(['card_balance' => $card_balance, 'group_id' => $corp_group, 'corp_maxlimit' => $corp_maxlimit, 'corp_minlimit' => $corp_minlimit, 'corp_transaction' => $corp_transaction, 'corp_enabled' => $corp_enabled]);
                            }
                        }
                        flash('card successfully added into your account.')->success();
                        return redirect()->route('dashboard.add_card');
                    }
                    else{
                        flash('something went wrong.')->error();
                        return back()->withInput($request->all());
                    }
                }
                else{
                    flash('Card is not aaded by you..')->error();
                    return back()->withInput($request->all());    
                }
           }
           else{
                flash('Please check your activation code, it is not match with our record.')->error();
                return back()->withInput($request->all());
           }
        }
        else{
            flash('This card is already added into your account')->error();
            /*if($card->user_id == Auth::id()){
                flash('This card is already added into your account')->error();
            }
            else{
                flash('This card is already added into another account')->error();   
            }*/
            return back()->withInput($request->all());
        }
    }

    public function remove_card(Request $request){
        $content  = ['status' => 204, 'message' => "something went wrong"];
        if(!empty($request->number)){
            $card = Card::where(['user_id' => Auth::id(), 'card_number' => $request->number])->first();
            if(!empty($card)){
                Card::destroy($card->id);
                $content['status'] = 200;
                $content['message'] = "Card successfully removed from your account";
            }
            else{
                $content['message'] = "Card is not found in your account.";
            }
        }
        else{
            $content['message'] = "Card number not found.";
        }

        return response()->json($content);    
    }

    public function refer(Request $request){
        $content  = ['status' => 204, 'message' => "something went wrong"];
        if(!empty($request->email)){
            $user = User::where('username', $request->email)->count();
            if($user){
                $content['message'] = "Your contact is already registered with us.";
            }
            else{
                $refer = Referral::where(['user_id' => Auth::id(), 'email' => $request->email])->count();
                if($refer){
                    $content['message'] = "You are already refer to this contact.";
                }
                else{
                    Mail::to($request->email)->send(new Referral_mail());
                    Referral::create(['user_id' => Auth::id(), 'email' => $request->email]);
                    $content['status'] = 200;
                    $content['message'] = "Email successfully sent to your contact.";
                }
            }
        }
        else{
            $content['message'] = "Email id not found.";
        }

        return  response()->json($content);
    }

    public function update_profile(Request $request){
        $rules = [
            'title' => 'required|string|max:4',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            // 'zip_code' => 'required|numeric',
            'surname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'dob' => 'required',
            'phone' => 'required|numeric',
            'mobile' => 'required|numeric',
            'company' => 'required|string|max:255',
            // 'currency' => 'required|string|max:255',
            // 'document' => 'required|string|max:255',
            // 'document_no' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,username,'.Auth::id().',id_user',
            // 'location' => 'required|string|max:255',
        ];

        $this->validateForm($request->all(),$rules);

        $user = Auth::user();

        if(!empty($user)){
            $user->birthsdate = $request->dob;

            $contact_data = [
                'business_name' => $request->company,
                'title' => $request->title,
                'firstname' => $request->name,
                'lastname' => $request->surname,
                'key_country' => $request->country,
                'city' => $request->city,
                'zip' => $request->zip_code,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'phone' => $request->phone,
                'email' => $request->email,
                // 'document' => $request->document,
                // 'document_no' => $request->document_no,
                // 'currency' => $request->currency,
            ];

            if(!empty($request->password)){
                if($request->email != $user->username){
                    $user->password = md5($request->password.strtolower($request->email).$request->password[2]);
                    $user->username = $request->email;
                }
                else{
                    $new_password = md5($request->password.strtolower($user->username).$request->password[2]);
                    if($user->password == $new_password){
                        flash('Current password and New password must not be same.')->error();
                        return back()->withInputs($request->all());
                    }
                    else{
                        $user->password = md5($request->password.strtolower($user->username).$request->password[2]);
                    }
                }
            }
            
            if($user->save()){
                Contact::where('key_user', $user->id_user)->update($contact_data);
                flash('Your profile updated successfully.')->success();
            }
            else{
                flash('Something went wrong.')->error();
            }
        }
        else{
            flash('User not found.')->error();
        }

        // if(!empty($request->name)){
        //     $user->name = $request->name;
        // }

        // if(!empty($request->password)){
        //     $user->password = bcrypt($request->password);
        // }

        // if(!empty($request->email)){
        //     $user->email = $request->email;
        // }

        // if($user->save()){
        //     flash('Your profile updated successfully.')->success();
        // }
        // else{
        //     flash('something went wrong')->eroor();
        // }

        if($request->advance_view == 'y'){
            $menu = 'advance';
        }
        else{
            $menu = 'simple';
        }

        return redirect()->route('dashboard.profile', $menu);
    }

    public function national_numbers(Request $request){
        $content  = ['status' => 204, 'message' => "something went wrong"];
        if(!empty($request->country)){
            $content['numbers'] = National_number::where('country', 'like', $request->country)->where(['allocated' => 0, 'active' => 1])->get();
            $content['status'] = 200;
            $content['message'] = "Success";
        }
        else{
            $content['message'] = "Country not found.";
        }
        return response()->json($content);
    }

    public function get_unique_otp(){
        $otp = rand(1000, 9999);
        $found = Card::where(['verification_code' => $otp, 'active' => 0])->first();
        if($found){
            return $this->get_unique_otp();
        }
        else{
            return $otp;
        }
    }

    public function get_packages(Request $request){
        $content  = ['status' => 204, 'message' => "something went wrong"];
        if(!empty($request->country)){
            $selected_zone = null;
            $zones = Zone::where('countries', '<>', '')->get();
            foreach ($zones as $zone) {
                $zone_countries = explode(', ', $zone->countries);
                if(in_array($request->country, $zone_countries)){
                    $selected_zone = $zone->id;
                }
            }
            if(!empty($selected_zone)){
                $content['packages'] = Gprs_package::where('zone_id', $selected_zone)->get();
                $content['status'] = 200;
                $content['message'] = "Packages successfully get";
            }
            else{
                $content['message'] = "There is no packages for selected country.";
            }
        }
        else{
            $content['message'] = "Country not found.";
        }
        return response()->json($content);
    }

    public function add_national_number(Request $request){
        $rules = [
            'xxsim_number' => 'required',
            'country' => 'required',
            'national_number' => 'required'
        ];

        $this->validateForm($request->all(),$rules);

        $national_number = National_number::where(['country' => $request->country, 'number' => $request->national_number])->first();

        if(!empty($national_number)){
            if(!($national_number->allocated)){
                $data = ['api_name'=> 'add_national_number', 'card'=> $request->xxsim_number, 'enum' => $national_number->number];
                $response = $this->card_api($request, $data);

                if($response['status'] == 200){  
                    $national_number->allocated = 1;
                    $national_number->save(); 

                    flash('National Number successfully added to your card.')->success();
                    return redirect()->route('dashboard.landline_activation_number');
                }
                else{
                    $data = ['api_name'=> 'add_secondary_national_number', 'card'=> $request->xxsim_number, 'enum' => $national_number->number];
                    $response = $this->card_api($request, $data);

                    if($response['status'] == 200){  
                        $national_number->allocated = 1;
                        $national_number->save(); 

                        flash('National Number successfully added to your card.')->success();
                        return redirect()->route('dashboard.landline_activation_number');
                    }
                    else{
                        flash($response['message'])->error();
                        return redirect()->route('dashboard.landline_activation');
                    }
                }
            }
            else{
                flash('National number is allocated to someone.')->error();
                return back()->withInput($request->all());
            }
        }
        else{
            flash('National number not found.')->error();
            return back()->withInput($request->all());
        }
    }

    public function get_groups(Request $request){
        $content  = ['status' => 204, 'message' => "something went wrong"];
        $group_ids = $final_groups = $group_balance = $groups = [];

        $groups = Card::where(['user_id' => Auth::id(), 'active' => 1, ['group_id', '<>', NULL]])->groupBy('group_id')->get();

        foreach ($groups as $group) {
            $cards = Card::select(['card_number as onum', 'corp_minlimit', 'corp_maxlimit'])->where(['user_id' => Auth::id(), 'active' => 1, 'group_id' => $group->group_id])->get()->toJson();
            $temp = new \stdClass();
            $temp->corp_group = $group->group->group_id;
            $temp->corp_remark = $group->group->group_name;
            $temp->corp_balance = $group->group->group_balance;
            $temp->group_cards = json_decode($cards);
            $final_groups[] = $temp;
            $group_ids[] = $group->group->group_id;
        }

        $extra_groups = Group::where(['user_id' => Auth::id()])->whereNotIn('group_id', $group_ids)->get();

        foreach ($extra_groups as $group) {
            $temp = new \stdClass();
            $temp->corp_group = $group->group_id;
            $temp->corp_remark = $group->group_name;
            $temp->corp_balance = $group->group_balance;
            $temp->group_cards = [];
            $final_groups[] = $temp;
            $group_ids[] = $group->group_id;
        }

        $data = ['api_name'=> 'get_group_list'];
        $response = $this->card_api($request, $data)->getData();
        if($response->status == 200){
            $result = json_decode($response->result)->group;
            foreach ($result as $value) {
                if(in_array($value->corp_group, $group_ids)){
                    $group_balance[] = $value;
                }
            }
        }
        else{
            $group_balance = $final_groups;
        }

        $content['status'] = 200;
        $content['message'] = "Success";
        $content['content'] = view('pages.dashboard.add_groups')->with('groups', $final_groups)->render();
        $content['group_balance'] = $group_balance;
        $content['groups'] = $final_groups;

        return response()->json($content);
    }

    public function add_group(Request $request){
        $content = ['status' => 412, 'message' => 'something went wrong'];
        $data = $request->data;
        if(!empty($data['action'])){
            switch ($data['action']) {
                case 'add_group':
                    Group::create(['user_id' => Auth::id(), 'group_id' => $data['group'], 'group_name' => $data['group_name'], 'group_balance' => '0.00' ]);
                    break;

                case 'update_group':
                    Group::where(['group_id' => $data['group']])->update(['group_name' => $data['group_name']]);
                    break;

                case 'add_card':
                    $group_id = Group::where(['group_id' => $data['group']])->value('id');
                    Card::where(['card_number' => $data['card']])->update(['group_id' => $group_id, 'corp_maxlimit' => $data['corp_maxlimit'], 'corp_minlimit' => $data['corp_minlimit'], 'corp_transaction' => $data['corp_transaction'], 'corp_enabled' => 1]);
                    break;

                case 'remove_card':
                    $group_id = Group::where(['group_id' => $data['group']])->value('id');
                    Card::where(['card_number' => $data['card'], 'group_id' => $group_id])->update(['group_id' => NULL, 'corp_maxlimit' => NULL, 'corp_minlimit' => NULL, 'corp_transaction' => NULL]);
                    break;

                case 'update_card':
                    $group_id = Group::where(['group_id' => $data['group']])->value('id');
                    Card::where(['card_number' => $data['card'], 'group_id' => $group_id])->update(['corp_maxlimit' => $data['corp_maxlimit'], 'corp_minlimit' => $data['corp_minlimit'], 'corp_transaction' => $data['corp_transaction'], 'corp_enabled' => 1]);
                    break;
                
                default:
                    # code...
                    break;
            }
            $content['status'] = 200;
        }

        return response()->json($content);
    }

    public function change_number_status(Request $request)
    {
        $content = ['status' => 200, 'message'=> 'Something went wrong.'];
        if(!empty($request->number)){
            National_number::where('number', $request->number)->update(['allocated' => 0]);
            $content['status'] = 200;
            $content['message'] = "National number successfully removed";
        }
        else{
            $content['message'] = "Number not found";
        }

        return response()->json($content);
    }

    public function get_cards(Request $request)
    {
        $content  = ['status' => 204, 'message' => "something went wrong"];
        $data = ['api_name'=> 'get_group_cards', 'corp_group' => $request->group_id];
        $response = $this->card_api($request, $data)->getData();

        if($response->status == 200){
            $result = json_decode($response->result);
            $cards = (!empty($result->card) ? (is_array($result->card) ? $result->card : [$result->card]) : new \stdClass());
            $user_cards = Card::where(['user_id' => Auth::id(), 'active' => 1])->get(['card_number', 'card_status'])->toArray();
            if(!empty($cards)){
                $data = '<li>
                            <p class="name"><span class="card-number">Card Number</span><span class="card-balance">Status</span><span class="card-balance">Balance</span></p>
                            <p class="form-title">Minimum balance</p>
                            <p class="form-title">Maximum balance</p>
                        </li>';
                foreach ($cards as $key => $card) {
                    $key = array_search($card->onum, array_column($user_cards, 'card_number'));
                    if(isset($key)){
                        $data .= '<li id="'.$card->corp_group . '_' . $card->onum .'">
                                    <p class="name"><span class="card-number">+'. $card->onum .'</span><span class="card-balance"> '. ($user_cards[$key]["card_status"] ? "Active" : "Inactive") .'</span><span class="card-balance"> &euro;'. $card->card_balance .'</span></p>
                                    <input type="text" class="form-control min-rate" value="'. $card->corp_minlimit .'" placeholder="Minimum amount balance" />
                                    <input type="text" class="form-control max-rate" value="'. $card->corp_maxlimit .'" placeholder="Maximum amount balance" />
                                    <button data-id="'. $card->corp_group . '_' . $card->onum .'" class="change-rate" type="buttton"><img src="'. asset("dashboard/images/right-mark.png") .'" alt="edit" /></button>
                                    <a href="javascript:;" data-id="'. $card->corp_group . '_' . $card->onum.'" class="icon card-delete"><img src="'. asset("dashboard/images/rubbish-bin.png") .'" alt="rubbish bin" /></a>
                                </li>';
                    }
                }
                $content['data'] = (!empty($data) ? $data : "<li>No cards available.</li>");
            }
            else{
                $content['data'] = "<li>No cards available.</li>";
            }
        }
        else{
            $content['data'] = "<li>No cards available.</li>";
        }

        $content['status'] = 200;
        $content['message'] = "Cards retrived successfully";

        return response()->json($content);
    }
}
