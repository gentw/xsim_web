<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Buy_card;
use App\Models\National_number;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.orders.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.orders.add');
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
            'user_id' => 'required',
            'qty_regular' => 'required',
            'qty_32' => 'required',
            'qty_50' => 'required',
            'status' => 'required',
        ];

        $this->validateForm($request->all(), $rules);

        $number = new Buy_card();
        $number->user_id = $request->user_id;
        $number->qty_regular = $request->qty_regular;
        $number->qty_32 = $request->qty_32;
        $number->qty_50 = $request->qty_50;
        $number->status = $request->status;

        if ($number->save()) {
            $number->order_number = date('Y') . '/' . date('m') . '/' . $number->id;
            $number->save();
            flash('Card order added successfully.')->success();
        } else {
            flash('Something went wrong.')->error();
        }

        return redirect()->route('admin.order.index');
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
            $order = Buy_card::findOrFail($id);
            return view('admin.pages.orders.show')->with('order', $order);
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
            $order = Buy_card::findOrFail($id);
            return view('admin.pages.orders.edit', ['order' => $order]);
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
        $rules = [
            'status' => 'required',
        ];

        $this->validateForm($request->all(), $rules);

        $order = Buy_card::find($id);

        if (!empty($order)) {
            $order->status = $request->status;

            if ($order->save()) {
                flash('Card order status updated successfully.')->success();
            } else {
                flash('Something went wrong.')->error();
            }
        } else {
            flash('Card order not found.')->error();
        }

        return redirect()->route('admin.order.index');
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
            Buy_card::destroy(explode(',', $request->ids));
            $content['status']=200;
            $content['message'] = "Card orders deleted successfully.";
            return response()->json($content);
        } else {
            Buy_card::destroy($id);
            if (request()->ajax()) {
                $content = array('status'=>200, 'message'=>"Card order deleted successfully.");
                return response()->json($content);
            } else {
                flash('Card order deleted successfully.')->success();
                return redirect()->route('admin.order.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));

        $count = Buy_card::leftJoin('user_contact as u', 'u.key_user', '=', 'buy_cards.user_id');
        if ($search != '') {
            $count->where(function ($query) use ($search) {
                $query->where("qty_regular", "like", "%{$search}%")
                ->orWhere("qty_32", "like", "%{$search}%")
                ->orWhere("qty_50", "like", "%{$search}%")
                ->orWhere("status", "like", "%{$search}%")
                ->orWhere("transaction_id", "like", "%{$search}%")
                ->orWhere("order_number", "like", "%{$search}%")
                ->orWhere("u.firstname", "like", "%{$search}%")
                ->orWhere("u.lastname", "like", "%{$search}%");
            });
        }
        $count = $count->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $orders = Buy_card::select(['buy_cards.*', 'u.firstname', 'u.lastname'])->leftJoin('user_contact as u', 'u.key_user', '=', 'buy_cards.user_id')->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        if ($search != '') {
            $orders->where(function ($query) use ($search) {
                $query->where("qty_regular", "like", "%{$search}%")
                ->orWhere("qty_32", "like", "%{$search}%")
                ->orWhere("qty_50", "like", "%{$search}%")
                ->orWhere("status", "like", "%{$search}%")
                ->orWhere("transaction_id", "like", "%{$search}%")
                ->orWhere("order_number", "like", "%{$search}%")
                ->orWhere("u.firstname", "like", "%{$search}%")
                ->orWhere("u.lastname", "like", "%{$search}%");
            });
        }
        $orders = $orders->get();
        foreach ($orders as $order) {
            $params = array(
               'checked'=> ($order->active ? "checked" : ""),
               'getaction'=>'',
               'class'=>'',
               'id'=> $order->id
            );
            $records['data'][] = [
                'checkbox'=>view('admin.shared.checkbox')->with('id', $order->id)->render(),
                'firstname' => $order->firstname . ' ' . $order->lastname,
                'qty_regular' => $order->qty_regular,
                'qty_32' => $order->qty_32,
                'qty_50' => $order->qty_50,
                'order_number' => $order->order_number,
                'transaction_id' => $order->transaction_id,
                'status' => ucwords($order->status),
                'action'=>view('admin.shared.actions')->with('id', $order->id)->render()
            ];
        }
        return $records;
    }
}
