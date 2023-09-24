<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\CardApiController;
use App\Models\Card;
use App\Models\Contact;
use App\Models\Country;
use App\Models\National_number;
use App\Models\Group;
use App\Models\Reload_data;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMgmtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.users.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.add', ['countries' => Country::orderBy('name')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:4',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            // 'zip_code' => 'required|numeric',
            'surname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'dob' => 'required',
            'country' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'document' => 'required|string|max:255',
            'document_no' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'mobile' => 'required|numeric',
            'company' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,username',
            'password' => 'required|string|min:6',
            // 'location' => 'required|string|max:255',
        ];

        $this->validateForm($request->all(), $rules);

        $password = $request->password.strtolower($request->email).$request->password[2];

        $user_data = [
            'key_user_sex' => 3,
            'key_language' => 2,
            'username' => $request->email,
            'password' => md5($password),
            'birthsdate' => date('Y-m-d H:i:s', strtotime($request->dob)),
            'key_user_status' => 2
        ];

        $user = User::create($user_data);

        $contact_data = [
            'key_user' => $user->id_user,
            'key_user_contact_type' => 1,
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
            'document' => $request->document,
            'document_no' => $request->document_no,
        ];

        $contact = Contact::create($contact_data);

        flash('User added successfully.')->success();

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::where('user_type', 'normal')->findOrFail($id);
            return view('admin.pages.users.show')->with('user', $user);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::where('user_type', 'normal')->findOrFail($id);
            return view('admin.pages.users.edit', ['countries' => Country::orderBy('name')->get(), 'user' => $user]);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!empty($request->action) && $request->action == 'change_status') {
            $content = ['status'=>204, 'message'=>"something went wrong"];
            $user = User::find($id);
            if ($user) {
                $user->active = ($request->value == 'y' ? 1 : 0);
                if ($user->save()) {
                    $content['status']=200;
                    $content['message'] = "Status updated successfully";
                }
            }
            return response()->json($content);
        } else {
            $rules = [
                'title' => 'required|string|max:4',
                'address' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                // 'zip_code' => 'required|numeric',
                'surname' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'dob' => 'required',
                'country' => 'required|string|max:255',
                'currency' => 'required|string|max:255',
                'document' => 'required|string|max:255',
                'document_no' => 'required|string|max:255',
                'phone' => 'required|numeric',
                'mobile' => 'required|numeric',
                'company' => 'required|string|max:255',
                // 'email' => 'required|string|email|max:255|unique:user,username,'.$id,
                // 'location' => 'required|string|max:255',
            ];

            $this->validateForm($request->all(), $rules);

            $user = User::find($id);

            if (!empty($user)) {
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
                    // 'email' => $request->email,
                    'document' => $request->document,
                    'document_no' => $request->document_no,
                    'currency' => $request->currency,
                ];

                if ($user->save()) {
                    Contact::where('key_user', $user->id_user)->update($contact_data);
                    flash('User updated successfully.')->success();
                } else {
                    flash('Something went wrong.')->error();
                }
            } else {
                flash('User not found.')->error();
            }

            return redirect()->route('admin.user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!empty($request->action) && $request->action == 'delete_all') {
            $content = ['status'=>204, 'message'=>"something went wrong"];
            User::destroy(explode(',', $request->ids));
            $content['status']=200;
            $content['message'] = "Users deleted successfully.";
            return response()->json($content);
        } else {
            User::destroy($id);
            if (request()->ajax()) {
                $content = array('status'=>200, 'message'=>"User deleted successfully.");
                return response()->json($content);
            } else {
                flash('User deleted successfully.')->success();
                return redirect()->route('admin.user.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));

        $count = User::where('user_type', 'normal')->leftJoin('user_contact as c', 'c.key_user', '=', 'user.id_user');
        if ($search != '') {
            $count->where(function ($query) use ($search) {
                $query->where("firstname", "like", "%{$search}%")
                ->orWhere("lastname", "like", "%{$search}%")
                ->orWhere("email", "like", "%{$search}%")
                ->orWhere("phone", "like", "%{$search}%")
                ->orWhere("zip", "like", "%{$search}%")
                ->orWhereHas('cards', function ($query) use ($search){
                    $query->where('card_number', "like", "%{$search}%");
                });
            });
        }
        $count = $count->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $users = User::select(['user.id_user', 'user.active', 'c.firstname', 'c.lastname', 'c.email', 'c.phone', 'c.zip'])->where('user_type', 'normal')->leftJoin('user_contact as c', 'c.key_user', '=', 'user.id_user')->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        if ($search != '') {
            $users->where(function ($query) use ($search) {
                $query->where("firstname", "like", "%{$search}%")
                ->orWhere("lastname", "like", "%{$search}%")
                ->orWhere("email", "like", "%{$search}%")
                ->orWhere("phone", "like", "%{$search}%")
                ->orWhere("zip", "like", "%{$search}%")
                ->orWhereHas('cards', function ($query) use ($search){
                    $query->where('card_number', "like", "%{$search}%");
                });
            });
        }
        $users = $users->get();
        foreach ($users as $user) {
            $params = array(
               'checked'=> ($user->active ? "checked" : ""),
               'getaction'=>'',
               'class'=>'',
               'id'=> $user->id_user
            );
            $records['data'][] = [
                'checkbox'=>view('admin.shared.checkbox')->with('id', $user->id_user)->render(),
                'firstname' => $user->firstname,
                'lastname'=> $user->lastname,
                'email'=> !empty($user->email) ? '<a href="mailto:' . $user->email . '" >' . $user->email . '</a>' : '',
                'phone'=> $user->phone,
                'zip'=> $user->zip,
                'active'=>view('admin.shared.switch', compact('params'))->render(),
                'action'=>view('admin.shared.actions')->with(['id' => $user->id_user, 'user' => true])->render()
            ];
        }
        return $records;
    }

    public function cards(Request $request, $id)
    {
        try {
            $user = User::where('user_type', 'normal')->findOrFail($id);
            return view('admin.pages.users.cards')->with('user', $user);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
    }

    public function card_listing(Request $request, $id)
    {
        extract($this->DTFilters($request->all()));

        $count = Card::where(['user_id' => $id, 'active' => 1]);
        if ($search != '') {
            $count->where(function ($query) use ($search) {
                $query->where("card_number", "like", "%{$search}%");
            });
        }
        $count = $count->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $users = Card::where(['user_id' => $id, 'active' => 1])->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        if ($search != '') {
            $users->where(function ($query) use ($search) {
                $query->where("card_number", "like", "%{$search}%");
            });
        }
        $cards = $users->get();

        $card_api = new CardApiController();
        foreach ($cards as $card) {
            $card_data = [
                'card_number' => $card->card_number,
                'validity' => (!empty($card->card_validity) ? $card->card_validity : 'N/A'),
            ];
            $data = ['api_name'=> 'get_balance', 'card'=> $card->card_number];
            $response = $card_api->card_api($request, $data)->getData();

            if($response->status == 200){
                $result = json_decode($response->result)->card;
                $card_data['balance'] = $result->balance;
            }
            else{
                $card_data['balance'] = 'N/A';
            }

            $data = ['api_name'=> 'get_all_enum', 'num' => $card->card_number];
            $response = $card_api->card_api($request, $data)->getData();

            if($response->status == 200){
                $result = json_decode($response->result);
                if(!empty($result->primary_enum)){
                    $card_data['enum'] = $result->primary_enum;
                }
                if(!empty($result->secondary_enum)){
                    $card_data['enum'] = (!empty($card_data['enum']) ? $card_data['enum'] . ', ' : '');
                    $card_data['enum'] .= (is_array($result->secondary_enum) ? implode(', ', $result->secondary_enum) : $result->secondary_enum);
                }
                if(empty($card_data['enum'])){
                    $card_data['enum'] = 'N/A';
                }
            }
            else{
                $card_data['enum'] = 'N/A';
            }

            $card_data['action'] = view('admin.shared.card_action')->with(['id' => $card->id,'card'=>$card->card_number,'user_id'=>$id, 'remove' => (!empty($card_data['enum']) && $card_data['enum'] != 'N/A' ? true : false), 'enumNumber' => $card_data['enum']])->render();

            $records['data'][] = $card_data;
        }
        return $records;
    }

    public function add_balance(Request $request, $id)
    {
        try {
            $card = Card::findOrFail($id);
            return view('admin.pages.users.add_balance')->with('card', $card);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
    }

    public function add_card_balance(Request $request)
    {
        $rules = [
            'number' => 'required',
            'balance' => 'required'
        ];

        $this->validateForm($request->all(), $rules);

        $card_api = new CardApiController();

        $data = ['api_name'=> 'account_details'];
        $response = $card_api->card_api($request, $data);

        if ($response['status'] == 200) {
            $result = json_decode($response['result']);
            $orderid = $result->orderid;
            if (!empty($orderid)) {
                $data = ['api_name'=> 'reload', 'card'=> $request->number, 'amount' => $request->balance, 'orderid' => ($orderid+1)];
                $response = $card_api->card_api($request, $data);

                if ($response['status'] == 200) {
                    Reload_data::create(['number' => $request->number, 'amount' => $request->balance, 'validity' => date('Y-m-d', strtotime("+1 year"))]);
                    flash("Card reloaded successfully.")->success();
                    return redirect()->route('admin.user.cards', $request->user_id);
                } else {
                    flash($response['message'])->error();
                    return back()->withInput($request->all());
                }
            } else {
                flash('Order id not found');
                return back()->withInput($request->all());
            }
        } else {
            flash($response['message'])->error();
            return back()->withInput($request->all());
        }
    }

    public function add_number(Request $request, $id)
    {
        try {
            $countries = National_number::where(['active' => 1])->distinct()->get(['country']);
            $card = Card::findOrFail($id);
            return view('admin.pages.users.add_number')->with(['card' => $card, 'countries' => $countries]);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
    }

    public function add_extra_number(Request $request)
    {
        $rules = [
            'country' => 'required',
            'number' => 'required',
        ];

        $this->validateForm($request->all(), $rules);

        $national_number = National_number::where(['country' => $request->country, 'number' => $request->number])->first();

        if (!empty($national_number)) {
            if (!($national_number->allocated)) {
                $card_api = new CardApiController();
                $data = ['api_name'=> 'add_national_number', 'card'=> $request->card_number, 'enum' => $national_number->number];
                $response = $card_api->card_api($request, $data);

                if ($response['status'] == 200) {
                    $national_number->allocated = 1;
                    $national_number->save();

                    flash('National Number added successfully.')->success();
                    return redirect()->route('admin.user.cards', $request->user_id);
                } else {
                    $data = ['api_name'=> 'add_secondary_national_number', 'card'=> $request->card_number, 'enum' => $national_number->number];
                    $response = $card_api->card_api($request, $data);

                    if($response['status'] == 200){  
                        $national_number->allocated = 1;
                        $national_number->save();

                        flash('National Number added successfully.')->success();
                        return redirect()->route('admin.user.cards', $request->user_id);
                    }
                    else{
                        flash($response['message'])->error();
                        return back();
                    }
                }
            } else {
                flash('National number is allocated to someone.')->error();
                return back()->withInput($request->all());
            }
        } else {
            flash('National number not found.')->error();
            return back()->withInput($request->all());
        }
    }

    public function national_number_list(Request $request, $id)
    {
        try {
            $card = Card::findOrFail($id);
            $national_numbers = [];
            $card_api = new CardApiController();
            $data = ['api_name'=> 'get_all_enum', 'num' => $card->card_number];
            $response = $card_api->card_api($request, $data);
            $primary_enum = '';

            if($response['status'] == 200){
                $result = json_decode($response['result']);
                if(!empty($result->primary_enum)){
                    $national_numbers[] = $result->primary_enum;
                    $primary_enum = $result->primary_enum;
                }
                if(!empty($result->secondary_enum)){
                    if(is_array($result->secondary_enum)){
                        $national_numbers = array_merge($national_numbers, $result->secondary_enum);
                    }
                    else{
                        $national_numbers[] = $result->secondary_enum;
                    }
                }
            }

            return view('admin.pages.users.remove_national_numbers')->with(['national_numbers'=> $national_numbers, 'primary_enum' => $primary_enum, 'card' => $card]);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
    }

    public function remove_number(Request $request, $id)
    {
        $card = Card::find($id);
        if (!empty($card)) {
            if(!empty($request->national_number)){
                if(!empty($request->type)){
                    if($request->type == 'primary'){
                        $data = ['api_name'=> 'add_national_number', 'card'=> $card->card_number, 'enum' => ''];
                    }
                    else{
                        $data = ['api_name'=> 'remove_national_number', 'card'=> $card->card_number, 'enum' => $request->national_number];
                    }
                    $card_api = new CardApiController();
                    $response = $card_api->card_api($request, $data);
                    if ($response['status'] == 200) {
                        National_number::where('number', $request->national_number)->update(['allocated' => 0]);
                        flash('National number removed successfully')->success();
                        return redirect()->route('admin.user.cards', $card->user_id);
                    } else {
                        flash($response['message'])->error();
                        return back()->withInput($request->all());
                    }
                }
            }
            else{
                flash('National number not found')->error();
                return redirect()->back();
            }
        } else {
            flash('Card not found')->error();
            return redirect()->back();
        }
    }

    public function card_add($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.pages.users.card_add')->with('user', $user);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
    }

    public function add_user_card(Request $request)
    {
        $rules = [
            'number' => 'required',
            'user_id' => 'required'
        ];

        $this->validateForm($request->all(), $rules);

        $card = Card::create(['user_id' => $request->user_id, 'card_number' => $request->number, 'card_status' => 1, 'active' => 1]);

        $card_api = new CardApiController();
        /* Active Card */
        $data = ['api_name'=> 'card_status', 'card'=> $request->number, 'block' => 'f'];
        $response = $card_api->card_api($request, $data);
        /* Active GPRS Service */
        $data = ['api_name'=> 'gprs_service_status', 'card'=> $request->number, 'block' => 'f'];
        $response = $card_api->card_api($request, $data);
        /* Get Group Info */
        $data = ['api_name'=> 'get_card_group_info', 'card'=> $request->number];
        $response = $card_api->card_api($request, $data);
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

        flash("Card successfully added.")->success();
        return redirect()->route('admin.user.cards', $request->user_id);
    }

    public function remove_user_card(Request $request, $user_id, $card_number)
    {
        $result = Card::where(['user_id'=>$user_id,'card_number'=>$card_number])->delete();

        $content['status'] = 204;
        $content['message'] = "Something Went Wrong!";

        if ($result) {
            $content['status'] = 200;
            $content['message'] = "Card removed successfully.";
        }
        return response()->json($content);
    }

    public function change_validity(Request $request, $id)
    {
        try {
            $card = Card::findOrFail($id);
            return view('admin.pages.users.change_validity')->with(['card' => $card]);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
    }

    public function update_validity(Request $request)
    {
        $rules = [
            'card_number' => 'required',
            'validity' => 'required',
        ];

        $this->validateForm($request->all(), $rules);

        $card = Card::where(['card_number' => $request->card_number])->first();
       
        if(!empty($card)){
            $card->card_validity = date('Y-m-d', strtotime($request->validity));
            $card->save();

            $card_api = new CardApiController();
            /* Active Card */
            $data = ['api_name'=> 'card_status', 'card'=> $request->number, 'block' => 'f'];
            $response = $card_api->card_api($request, $data);
            /* Active GPRS Service */
            $data = ['api_name'=> 'gprs_service_status', 'card'=> $request->number, 'block' => 'f'];
            $response = $card_api->card_api($request, $data);

            flash("Card validity updated successfully.")->success();
        }
        else{
            flash("Card not found.")->success();
        }

        return redirect()->route('admin.user.cards', $card->user_id);
    }

    public function export_age_group()
    {
        $ages = [];
        $users = User::all();
        foreach ($users as $user) {
            $ages[] = $user->age;
        }
        $total = count($users);
        $less_than_ten = array_reduce($ages, function ($a, $b) { return ($b <= 10) ? ++$a : $a; });
        $eleven_to_twenty = array_reduce($ages, function ($a, $b) { return ($b > 10 && $b <=20) ? ++$a : $a; });
        $twentyone_to_thirty = array_reduce($ages, function ($a, $b) { return ($b > 20 && $b <=30) ? ++$a : $a; });
        $thirtyone_to_fourty = array_reduce($ages, function ($a, $b) { return ($b > 30 && $b <=40) ? ++$a : $a; });
        $fourtyone_to_fifty = array_reduce($ages, function ($a, $b) { return ($b > 40 && $b <=50) ? ++$a : $a; });
        $fiftyone_to_sixty = array_reduce($ages, function ($a, $b) { return ($b > 50 && $b <=60) ? ++$a : $a; });
        $sixtyone_to_seventy = array_reduce($ages, function ($a, $b) { return ($b > 60 && $b <=70) ? ++$a : $a; });
        $seventyone_to_eighty = array_reduce($ages, function ($a, $b) { return ($b > 70 && $b <=80) ? ++$a : $a; });
        $eightyone_to_ninety = array_reduce($ages, function ($a, $b) { return ($b > 80 && $b <=90) ? ++$a : $a; });
        $ninetyone_to_hundred = array_reduce($ages, function ($a, $b) { return ($b > 90 && $b <=100) ? ++$a : $a; });
        $greater_than_hundred = array_reduce($ages, function ($a, $b) { return ($b > 100) ? ++$a : $a; });

        $sheet_array[] = ['Group', 'Total Count', 'Percentage'];
        $sheet_array[] = ['Less than or equal to 10', $less_than_ten, round(($less_than_ten / $total * 100), 2)];
        $sheet_array[] = ['11 - 20', $eleven_to_twenty, round(($eleven_to_twenty / $total * 100), 2)];
        $sheet_array[] = ['21 - 30', $twentyone_to_thirty, round(($twentyone_to_thirty / $total * 100), 2)];
        $sheet_array[] = ['31 - 40', $thirtyone_to_fourty, round(($thirtyone_to_fourty / $total * 100), 2)];
        $sheet_array[] = ['41 - 50', $fourtyone_to_fifty, round(($fourtyone_to_fifty / $total * 100), 2)];
        $sheet_array[] = ['51 - 60', $fiftyone_to_sixty, round(($fiftyone_to_sixty / $total * 100), 2)];
        $sheet_array[] = ['61 - 70', $sixtyone_to_seventy, round(($sixtyone_to_seventy / $total * 100), 2)];
        $sheet_array[] = ['71 - 80', $seventyone_to_eighty, round(($seventyone_to_eighty / $total * 100), 2)];
        $sheet_array[] = ['81 - 90', $eightyone_to_ninety, round(($eightyone_to_ninety / $total * 100), 2)];
        $sheet_array[] = ['91 - 100', $ninetyone_to_hundred, round(($ninetyone_to_hundred / $total * 100), 2)];
        $sheet_array[] = ['Greater than 100', $greater_than_hundred, round(($greater_than_hundred / $total * 100), 2)];
        $sheet_array[] = ['Total Users', $total];

        \Excel::create('Age Groups', function($excel) use($sheet_array) {
            $excel->sheet('Groups', function($sheet) use($sheet_array){
                $sheet->setAllBorders('thin');
                $sheet->fromArray($sheet_array ,null, 'A1', true, false);            
            });
        })->export('xlsx');
    }
}
