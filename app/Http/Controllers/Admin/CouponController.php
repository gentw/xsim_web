<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CardType;
use App\Models\Press;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.coupons.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.coupons.add', ['cardtypes' => CardType::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cardtypes = CardType::pluck('id')->toArray();
        
        $rules = [
            'title' => 'required',
            'discount' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'card_type_id' => 'in:'.implode(',', $cardtypes),
        ];

        $this->validateForm($request->all(),$rules);

        $coupon = new Coupon();
        $coupon->title = $request->title;
        $coupon->discount = $request->discount;
        $coupon->card_type_id = $request->card;
        $coupon->min_order_amount = $request->min_order_amount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        
        $coupon->save();
        flash('Coupon added sucessfully.')->success();
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
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
            $coupon = Coupon::findOrFail($id);
            return view('admin.pages.coupons.edit')->with(['coupon' => $coupon,'cardtypes' => CardType::get()]);
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
        $cardtypes = CardType::pluck('id')->toArray();

          $rules = [
            'title' => 'required',
            'discount' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'card_type_id' => 'in:'.implode(',', $cardtypes),
        ];

        $this->validateForm($request->all(),$rules);

        $coupon = Coupon::find($id);
        if(!empty($coupon)){
            $coupon->title = $request->title;
            $coupon->discount = $request->discount;
            $coupon->card_type_id = $request->card;
            $coupon->min_order_amount = $request->min_order_amount;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->save();
            flash('Coupon updated sucessfully.')->success();
            return redirect()->route('admin.coupons.index');
        }
        else{
            flash('Coupon not found.')->error();
            return redirect()->route('admin.coupons.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if(!empty($request->action) && $request->action == 'delete_all'){
            $content = ['status'=>204, 'message'=>"something went wrong"];
            Coupon::destroy(explode(',',$request->ids));
            $content['status']=200;
            $content['message'] = "Coupons deleted successfully.";
            return response()->json($content);
        }
        else{
            Coupon::destroy($id);
            if(request()->ajax()){
                $content = array('status'=>200, 'message'=>"Coupon deleted successfully.");
                return response()->json($content);
            }else{
                flash('Coupon deleted successfully.')->success();
                return redirect()->route('admin.coupons.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));

        $count = Coupon::with(['card_type'])->where('id', '<>', 0);
        if($search != ''){
            $count->where(function($query) use ($search){
                $query->where("title", "like", "%{$search}%");
            });
        }
        $count = $count->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $coupons = Coupon::with('card_type')->where('id', '<>', 0)->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        
        if($search != ''){
            $coupons->where(function($query) use ($search){
                $query->where("title", "like", "%{$search}%");
            });
        }
        $coupons = $coupons->get();
        
        foreach ($coupons as $coupon) {
            
            $card_type = (!empty($coupon->card_type_id)) ? $coupon->card_type->type_name : "";

            $records['data'][] = [
                'checkbox'=>view('admin.shared.checkbox')->with('id',$coupon->id)->render(),
                'title'=> $coupon->title,
                'card_type_id'  => $card_type,
                'discount'=> $coupon->discount,
                'min_order_amount'=> $coupon->min_order_amount,
                'start_date'=> $coupon->start_date,
                'end_date'=> $coupon->end_date,
                'action'=>view('admin.shared.actions')->with('id', $coupon->id)->render()
            ];
        }
        return $records;
    }
}