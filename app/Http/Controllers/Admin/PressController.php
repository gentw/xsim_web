<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Press;
use Illuminate\Http\Request;

class PressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.presses.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.presses.add');
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
            'type' => 'required',
            'language' => 'required',
            'title' => 'required',
            'file_type' => 'required',
        ];

        $this->validateForm($request->all(),$rules);

        $press = new Press();
        $press->type = $request->type;
        $press->language = $request->language;
        $press->title = $request->title;

        if($request->file_type == "file"){
            $path = $request->file('file')->store('presses');
            $press->link = env('APP_URL') . 'storage/app/' . $path;
        }
        else{
            $press->link = $request->link;
        }
        
        $press->save();
        flash('Press added sucessfully.')->success();
        return redirect()->route('admin.presses.index');
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
            $press = Press::findOrFail($id);
            return view('admin.pages.presses.edit')->with('press', $press);
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
        $rules = [
            'type' => 'required',
            'language' => 'required',
            'title' => 'required',
        ];

        $this->validateForm($request->all(),$rules);

        $press = Press::find($id);
        if(!empty($press)){
            $press->type = $request->type;
            $press->language = $request->language;
            $press->title = $request->title;

            if(!empty($request->file_type) && (!empty($request->link) || !empty($request->file))){
                if($request->file_type == "file"){
                    $path = $request->file('file')->store('presses');
                    $press->link = env('APP_URL') . 'storage/app/' . $path;
                }
                else{
                    $press->link = $request->link;
                }
            }
            
            $press->save();
            flash('Press updated sucessfully.')->success();
            return redirect()->route('admin.presses.index');
        }
        else{
            flash('Press not found.')->success();
            return redirect()->route('admin.presses.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($request->action) && $request->action == 'delete_all'){
            $content = ['status'=>204, 'message'=>"something went wrong"];
            Press::destroy(explode(',',$request->ids));
            $content['status']=200;
            $content['message'] = "Presses deleted successfully.";
            return response()->json($content);
        }
        else{
            Press::destroy($id);
            if(request()->ajax()){
                $content = array('status'=>200, 'message'=>"Press deleted successfully.");
                return response()->json($content);
            }else{
                flash('Press deleted successfully.')->success();
                return redirect()->route('admin.presses.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));

        $count = Press::where('id', '<>', 0);
        if($search != ''){
            $count->where(function($query) use ($search){
                $query->where("type", "like", "%{$search}%")
                ->orWhere("language", "like", "%{$search}%")
                ->orWhere("title", "like", "%{$search}%");
            });
        }
        $count = $count->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $presses = Press::where('id', '<>', 0)->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        if($search != ''){
            $presses->where(function($query) use ($search){
                $query->where("type", "like", "%{$search}%")
                ->orWhere("language", "like", "%{$search}%")
                ->orWhere("title", "like", "%{$search}%");
            });
        }
        $presses = $presses->get();
        foreach ($presses as $press) {
            $params = array(
               'checked'=> ($press->active ? "checked" : ""),
               'getaction'=>'',
               'class'=>'',
               'id'=> $press->id
            );
            $records['data'][] = [
                'checkbox'=>view('admin.shared.checkbox')->with('id',$press->id)->render(),
                'type' => $press->type,
                'language'=> $press->language,
                'title'=> $press->title,
                'link' => '<a href="' . $press->link . '" target="_blank">' . $press->link . '</a>',
                'action'=>view('admin.shared.actions')->with('id', $press->id)->render()
            ];
        }
        return $records;
    }
}
