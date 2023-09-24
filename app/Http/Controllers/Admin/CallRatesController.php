<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Models\Country;
use App\Models\Call_rate;
use Excel;

use App\Mail\CoutryAdd;

class CallRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.rates.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.rates.add', ['countries' => Country::orderBy('name')->get()]);
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
            'country' => 'required|string|max:255',
        ];

        $this->validateForm($request->all(),$rules);

        $call_rate = new Call_rate();

        $call_rate->carrier = !empty($request->carrier) ? $request->carrier : NULL;
        $call_rate->country = !empty($request->country) ? $request->country : NULL;
        $call_rate->operator = !empty($request->operator) ? $request->operator : NULL;
        $call_rate->network_type = !empty($request->network_type) ? $request->network_type : NULL;
        $call_rate->network = !empty($request->network) ? $request->network : NULL;
        $call_rate->abbreviation = !empty($request->abbreviation) ? $request->abbreviation : NULL;
        $call_rate->code = !empty($request->code) ? $request->code : NULL;
        $call_rate->link_1 = !empty($request->link_1) ? $request->link_1 : NULL;
        $call_rate->link_2 = !empty($request->link_2) ? $request->link_2 : NULL;
        $call_rate->link_3 = !empty($request->link_3) ? $request->link_3 : NULL;
        $call_rate->gprs = !empty($request->gprs) ? $request->gprs : 0;
        $call_rate->net_3g = !empty($request->net_3g) ? $request->net_3g : 0;
        $call_rate->preferred = !empty($request->preferred) ? $request->preferred : 0;
        $call_rate->active = !empty($request->active) ? $request->active : 0;
        $call_rate->sms_in_rate = !empty($request->sms_in_rate) ? $request->sms_in_rate : NULL;
        $call_rate->sms_out_rate = !empty($request->sms_out_rate) ? $request->sms_out_rate : NULL;
        $call_rate->xxsim_sms_rate = !empty($request->xxsim_sms_rate) ? $request->xxsim_sms_rate : NULL;
        $call_rate->zone = !empty($request->zone) ? $request->zone : NULL;
        $call_rate->zone_rate = !empty($request->zone_rate) ? $request->zone_rate : NULL;
        $call_rate->gprs_rate = !empty($request->gprs_rate) ? $request->gprs_rate : NULL;
        $call_rate->call_in_rate = !empty($request->call_in_rate) ? $request->call_in_rate : NULL;
        $call_rate->call_out_rate = !empty($request->call_out_rate) ? $request->call_out_rate : NULL;
        $call_rate->extra_rate = !empty($request->extra_rate) ? $request->extra_rate : NULL;
        $call_rate->xxsim_call_rate = !empty($request->xxsim_call_rate) ? $request->xxsim_call_rate : NULL;
        $call_rate->call_xxsim_to_xxsim = !empty($request->call_xxsim_to_xxsim) ? $request->call_xxsim_to_xxsim : NULL;
        $call_rate->sms_xxsim_to_xxsim = !empty($request->sms_xxsim_to_xxsim) ? $request->sms_xxsim_to_xxsim : NULL;
        $call_rate->voicemail = !empty($request->voicemail) ? $request->voicemail : NULL;
        $call_rate->comment = !empty($request->comment) ? $request->comment : NULL;

        if($call_rate->save()){
            flash('Call rate added successfully.')->success();
        }
        else{
            flash('Something went wrong.')->error();
        }

        return redirect()->route('admin.rate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $rate = Call_rate::findOrFail($id);
            return view('admin.pages.rates.show')->with('rate', $rate);
        }catch(ModelNotFoundException $ex){
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
        try{
            $rate = Call_rate::findOrFail($id);
            return view('admin.pages.rates.edit', ['countries' => Country::orderBy('name')->get(), 'rate' => $rate]);
        }catch(ModelNotFoundException $ex){
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
        if(!empty($request->action) && $request->action == 'change_status'){
            $content = ['status'=>204, 'message'=>"something went wrong"];
            $call_rate = Call_rate::find($id);
            if($call_rate){
                $call_rate->active = ($request->value == 'y' ? 1 : 0);
                if($call_rate->save()){
                    $content['status']=200;
                    $content['message'] = "Status updated successfully";
                }
            }
            return response()->json($content);
        }
        else{
            $rules = [
                'country' => 'required|string|max:255',
            ];

            $this->validateForm($request->all(),$rules);

            $call_rate = Call_rate::find($id);

            if(!empty($call_rate)){
                $call_rate->carrier = !empty($request->carrier) ? $request->carrier : NULL;
                $call_rate->country = !empty($request->country) ? $request->country : NULL;
                $call_rate->operator = !empty($request->operator) ? $request->operator : NULL;
                $call_rate->network_type = !empty($request->network_type) ? $request->network_type : NULL;
                $call_rate->network = !empty($request->network) ? $request->network : NULL;
                $call_rate->abbreviation = !empty($request->abbreviation) ? $request->abbreviation : NULL;
                $call_rate->code = !empty($request->code) ? $request->code : NULL;
                $call_rate->link_1 = !empty($request->link_1) ? $request->link_1 : NULL;
                $call_rate->link_2 = !empty($request->link_2) ? $request->link_2 : NULL;
                $call_rate->link_3 = !empty($request->link_3) ? $request->link_3 : NULL;
                $call_rate->gprs = !empty($request->gprs) ? $request->gprs : NULL;
                $call_rate->net_3g = !empty($request->net_3g) ? $request->net_3g : NULL;
                $call_rate->preferred = !empty($request->preferred) ? $request->preferred : NULL;
                $call_rate->active = !empty($request->active) ? $request->active : NULL;
                $call_rate->sms_in_rate = !empty($request->sms_in_rate) ? $request->sms_in_rate : NULL;
                $call_rate->sms_out_rate = !empty($request->sms_out_rate) ? $request->sms_out_rate : NULL;
                $call_rate->xxsim_sms_rate = !empty($request->xxsim_sms_rate) ? $request->xxsim_sms_rate : NULL;
                $call_rate->zone = !empty($request->zone) ? $request->zone : NULL;
                $call_rate->zone_rate = !empty($request->zone_rate) ? $request->zone_rate : NULL;
                $call_rate->gprs_rate = !empty($request->gprs_rate) ? $request->gprs_rate : NULL;
                $call_rate->call_in_rate = !empty($request->call_in_rate) ? $request->call_in_rate : NULL;
                $call_rate->call_out_rate = !empty($request->call_out_rate) ? $request->call_out_rate : NULL;
                $call_rate->extra_rate = !empty($request->extra_rate) ? $request->extra_rate : NULL;
                $call_rate->xxsim_call_rate = !empty($request->xxsim_call_rate) ? $request->xxsim_call_rate : NULL;
                $call_rate->call_xxsim_to_xxsim = !empty($request->call_xxsim_to_xxsim) ? $request->call_xxsim_to_xxsim : NULL;
                $call_rate->sms_xxsim_to_xxsim = !empty($request->sms_xxsim_to_xxsim) ? $request->sms_xxsim_to_xxsim : NULL;
                $call_rate->voicemail = !empty($request->voicemail) ? $request->voicemail : NULL;
                $call_rate->comment = !empty($request->comment) ? $request->comment : NULL; 
                
                if($call_rate->save()){
                    flash('Call rate updated successfully.')->success();
                }
                else{
                    flash('Something went wrong.')->error();
                }
            }
            else{
                flash('Call rate not found.')->error();
            }

            return redirect()->route('admin.rate.index');
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
        if(!empty($request->action) && $request->action == 'delete_all'){
            $content = ['status'=>204, 'message'=>"something went wrong"];
            Call_rate::destroy(explode(',',$request->ids));
            $content['status']=200;
            $content['message'] = "Call rates deleted successfully.";
            return response()->json($content);
        }
        else{
            Call_rate::destroy($id);
            if(request()->ajax()){
                $content = array('status'=>200, 'message'=>"Call rate record is deleted successfully.");
                return response()->json($content);
            }else{
                flash('Call rate deleted successfully.')->success();
                return redirect()->route('admin.rate.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));

        $count = Call_rate::where('id', '<>', 0);
        if($search != ''){
            $count->where(function($query) use ($search){
                $query->where("country", "like", "%{$search}%")
                ->orWhere("operator", "like", "%{$search}%")
                ->orWhere("sms_in_rate", "like", "%{$search}%")
                ->orWhere("sms_out_rate", "like", "%{$search}%")
                ->orWhere("call_in_rate", "like", "%{$search}%")
                ->orWhere("call_out_rate", "like", "%{$search}%");
            });
        }
        $count = $count->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $rates = Call_rate::where('id', '<>', 0)->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        if($search != ''){
            $rates->where(function($query) use ($search){
                $query->where("country", "like", "%{$search}%")
                ->orWhere("operator", "like", "%{$search}%")
                ->orWhere("sms_in_rate", "like", "%{$search}%")
                ->orWhere("sms_out_rate", "like", "%{$search}%")
                ->orWhere("call_in_rate", "like", "%{$search}%")
                ->orWhere("call_out_rate", "like", "%{$search}%");
            });
        }
        $rates = $rates->get();
        foreach ($rates as $rate) {
            $params = array(
               'checked'=> ($rate->active ? "checked" : ""),
               'getaction'=>'',
               'class'=>'',
               'id'=> $rate->id
            );
            $records['data'][] = [
                'checkbox'=>view('admin.shared.checkbox')->with('id',$rate->id)->render(),
                'country' => $rate->country,
                'operator'=> $rate->operator,
                'sms_in_rate'=> $rate->sms_in_rate,
                'sms_out_rate'=> $rate->sms_out_rate,
                'call_in_rate'=> $rate->call_in_rate,
                'call_out_rate'=> $rate->call_out_rate,
                'active'=>view('admin.shared.switch', compact('params'))->render(),
                'action'=>view('admin.shared.actions')->with('id', $rate->id)->render()
            ];
        }
        return $records;
    }

    public function import(Request $request)
    {
        if($request->file('import_file'))
        {
            ini_set('max_execution_time', 180);
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader)
            {
            })->get();

            if(!empty($data) && $data->count())
            {
                $dataArray = [];

                $import_array = $data->toArray();

                foreach ($import_array[0] as $row)
                {
                    if(!empty($row) && !empty($row['country']))
                    {
                        $dataArray[] =
                        [
                            'carrier' => (!empty($row['carrier']) ? $row['carrier'] : NULL),
                            'country' => (!empty($row['country']) ? $row['country'] : NULL),
                            'operator' => (!empty($row['operator']) ? $row['operator'] : NULL),
                            'network_type' => (!empty($row['network_type']) ? $row['network_type'] : NULL),
                            'network' => (!empty($row['network']) ? $row['network'] : NULL),
                            'abbreviation' => (!empty($row['abbreviation']) ? $row['abbreviation'] : NULL),
                            'code' => (!empty($row['code']) ? $row['code'] : NULL),
                            'link_1' => (!empty($row['link_1']) ? $row['link_1'] : NULL),
                            'link_2' => (!empty($row['link_2']) ? $row['link_2'] : NULL),
                            'link_3' => (!empty($row['link_3']) ? $row['link_3'] : NULL),
                            'gprs' => (!empty($row['gprs']) ? 1 : 0),
                            'net_3g' => (!empty($row['3g']) ? 1 : 0),
                            'preferred' => (!empty($row['preferred']) ? 1 : 0),
                            'active' => ($row['inactive'] == "Inactive" ? 0 :1),
                            'sms_in_rate' => ($row['sms_eur_incoming'] == "free" ? 0.00 : (is_numeric($row['sms_eur_incoming']) ? $row['sms_eur_incoming'] : NULL)),
                            'sms_out_rate' => ($row['sms_eur_outgoing'] == "free" ? 0.00 : (is_numeric($row['sms_eur_outgoing']) ? $row['sms_eur_outgoing'] : NULL)),
                            'xxsim_sms_rate' => (is_numeric($row['travelsms']) ? $row['travelsms'] : NULL),
                            'zone' => (is_numeric($row['zone']) ? $row['zone'] : NULL),
                            'zone_rate' => (is_numeric($row['zone_rates']) ? $row['zone_rates'] : NULL),
                            'gprs_rate' => (is_numeric($row['gprs_eur100kb']) ? $row['gprs_eur100kb'] : NULL),
                            'call_in_rate' => (is_numeric($row['incoming_eur']) ? $row['incoming_eur'] : NULL),
                            'call_out_rate' => (is_numeric($row['outgoing_eur']) ? $row['outgoing_eur'] : NULL),
                            'extra_rate' => (is_numeric($row['extra_eur']) ? $row['extra_eur'] : NULL),
                            'xxsim_call_rate' => (is_numeric($row['travelsim_eur']) ? $row['travelsim_eur'] : NULL),
                            'call_xxsim_to_xxsim' => (is_numeric($row['eu_to_eu_eur']) ? $row['eu_to_eu_eur'] : NULL),
                            'sms_xxsim_to_xxsim' => (is_numeric($row['sms_from_eu_to_eu']) ? $row['sms_from_eu_to_eu'] : NULL),
                            'voicemail' => (is_numeric($row['voicemail_eur']) ? $row['voicemail_eur'] : NULL),
                            'comment' => (is_numeric($row['comment']) ? $row['comment'] : NULL),
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now(),
                        ];
                    }
                }

                if(!empty($dataArray))
                {
                    Call_rate::truncate();
                    Call_rate::insert($dataArray);
                    flash('Call rate list updated successfully.')->success();
                    return redirect()->route('admin.rate.index');
                }
                else{
                    flash('Please upload a correct formated sheet.')->error();
                    return back();   
                }
            }
        }else{
            flash('File not found.')->error();
            return redirect()->route('admin.rate.index');
        }   
    }

    public function country_add()
    {
        $countries = Call_rate::where('zone_rate', '<>', NULL)->where('active', 1)->distinct()->get(['country']);
        return view('admin.pages.rates.country_add', ['countries' => $countries]);
    }

    public function sendMail(Request $request)
    {
        $rules = [
            'country' => 'required|string|max:255',
        ];

        $this->validateForm($request->all(),$rules);

        $rates = Call_rate::where('country', 'like', '%' . $request->country . '%')->get();

        if(!empty($rates)){
            $out_call = 0;
            $out_sms = 0;

            foreach ($rates as $rate) {
                if(empty($out_call) || !empty($rate->call_out_rate) && $out_call > $rate->call_out_rate) $out_call = $rate->call_out_rate;
                if(empty($out_sms) || !empty($rate->sms_out_rate) && $out_sms > $rate->sms_out_rate) $out_sms = $rate->sms_out_rate;
            }

            Mail::to('kirtan@yudiz.com')->queue(new CoutryAdd(['country' => $request->country,'out_call' => $out_call, 'out_sms' => $out_sms]));

            flash('Mail successfully send.')->success();
            return redirect()->route('admin.rate.index');
        }
        else{
            flash('country not found.')->error();
            return redirect()->back()->withInput($request->all());
        }
    }
}
