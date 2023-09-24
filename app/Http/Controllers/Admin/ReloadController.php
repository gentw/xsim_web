<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reload_data;
use Illuminate\Http\Request;

class ReloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.reloads.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
            Reload_data::destroy(explode(',', $request->ids));
            $content['status']=200;
            $content['message'] = "Reload records are deleted successfully.";
            return response()->json($content);
        } else {
            Reload_data::destroy($id);
            if (request()->ajax()) {
                $content = array('status'=>200, 'message'=>"Reload record is deleted successfully.");
                return response()->json($content);
            } else {
                flash('Reload record is deleted successfully.')->success();
                return redirect()->route('admin.reload.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));

        $count = Reload_data::select(['reload_data.*', 'u.firstname', 'u.lastname'])->join('cards as c', 'c.card_number', '=', 'reload_data.number')->join('user_contact as u', 'u.key_user', '=', 'c.user_id');
        if ($search != '') {
            $count->where(function ($query) use ($search) {
                $query->where("number", "like", "%{$search}%")
                ->orWhere("reload_data.amount", "like", "%{$search}%")
                ->orWhere("reload_data.validity", "like", "%{$search}%")
                ->orWhere("reload_data.transaction_id", "like", "%{$search}%")
                ->orWhere("reload_data.created_at", "like", "%{$search}%")
                ->orWhere("u.firstname", "like", "%{$search}%")
                ->orWhere("u.lastname", "like", "%{$search}%");
            });
        }
        $count = $count->groupBy('reload_data.created_at')->get()->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $orders = Reload_data::select(['reload_data.*', 'u.firstname', 'u.lastname'])->join('cards as c', 'c.card_number', '=', 'reload_data.number')->join('user_contact as u', 'u.key_user', '=', 'c.user_id')->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        if ($search != '') {
            $orders->where(function ($query) use ($search) {
                $query->where("number", "like", "%{$search}%")
                ->orWhere("reload_data.amount", "like", "%{$search}%")
                ->orWhere("reload_data.validity", "like", "%{$search}%")
                ->orWhere("reload_data.transaction_id", "like", "%{$search}%")
                ->orWhere("reload_data.created_at", "like", "%{$search}%")
                ->orWhere("u.firstname", "like", "%{$search}%")
                ->orWhere("u.lastname", "like", "%{$search}%");
            });
        }
        $orders = $orders->groupBy('reload_data.created_at')->get();
        foreach ($orders as $order) {
            $params = array(
               'checked'=> ($order->active ? "checked" : ""),
               'getaction'=>'',
               'class'=>'',
               'id'=> $order->id
            );
            $records['data'][] = [
                'checkbox'=>view('admin.shared.checkbox')->with('id', $order->id)->render(),
                'number' => $order->number,
                'amount' => $order->amount,
                'validity' => $order->validity,
                'firstname' => $order->firstname,
                'lastname' => $order->lastname,
                'transaction_id' => $order->transaction_id,
                'created_at' => (String) $order->created_at,
                'action'=>view('admin.shared.actions')->with('id', $order->id)->render()
            ];
        }
        return $records;
    }
}
