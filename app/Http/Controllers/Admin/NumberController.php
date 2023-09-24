<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\National_number;
use Excel;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.numbers.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.numbers.add');
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
            'number' => 'required',
            'setup_fee' => 'required',
            'monthly_fee' => 'required',
        ];

        $this->validateForm($request->all(),$rules);

        $number = new National_number();
        $number->country = $request->country;
        $number->number = $request->number;
        $number->setup_fee = $request->setup_fee;
        $number->monthly_fee = $request->monthly_fee;
        $number->allocated = $request->allocated;
        $number->active = $request->active;

        if($number->save()){
            flash('National number added successfully.')->success();
        }
        else{
            flash('Something went wrong.')->error();
        }

        return redirect()->route('admin.number.index');
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
            $number = National_number::findOrFail($id);
            return view('admin.pages.numbers.show')->with('number', $number);
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
            $number = National_number::findOrFail($id);
            return view('admin.pages.numbers.edit', ['number' => $number]);
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
            $number = National_number::find($id);
            if($number){
                $number->active = ($request->value == 'y' ? 1 : 0);
                if($number->save()){
                    $content['status']=200;
                    $content['message'] = "Status updated successfully";
                }
            }
            return response()->json($content);
        }
        else{
            $rules = [
                'country' => 'required|string|max:255',
                'number' => 'required',
                'setup_fee' => 'required',
                'monthly_fee' => 'required',
            ];

            $this->validateForm($request->all(),$rules);

            $number = National_number::find($id);

            if(!empty($number)){
                $number->country = $request->country;
                $number->number = $request->number;
                $number->setup_fee = $request->setup_fee;
                $number->monthly_fee = $request->monthly_fee;
                $number->allocated = $request->allocated;
                $number->active = $request->active;

                if($number->save()){
                    flash('National number updated successfully.')->success();
                }
                else{
                    flash('Something went wrong.')->error();
                }
            }
            else{
                flash('National number not found.')->error();
            }

            return redirect()->route('admin.number.index');
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
            National_number::destroy(explode(',',$request->ids));
            $content['status']=200;
            $content['message'] = "National numbers deleted successfully.";
            return response()->json($content);
        }
        else{
            National_number::destroy($id);
            if(request()->ajax()){
                $content = array('status'=>200, 'message'=>"National number deleted successfully.");
                return response()->json($content);
            }else{
                flash('National number deleted successfully.')->success();
                return redirect()->route('admin.number.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));

        $count = National_number::where('id', '<>', 0);
        if($search != ''){
            $count->where(function($query) use ($search){
                $query->where("country", "like", "%{$search}%")
                ->orWhere("number", "like", "%{$search}%")
                ->orWhere("setup_fee", "like", "%{$search}%");
            });
        }
        $count = $count->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $numbers = National_number::where('id', '<>', 0)->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        if($search != ''){
            $numbers->where(function($query) use ($search){
                $query->where("country", "like", "%{$search}%")
                ->orWhere("number", "like", "%{$search}%")
                ->orWhere("setup_fee", "like", "%{$search}%");
            });
        }
        $numbers = $numbers->get();
        foreach ($numbers as $number) {
            $params = array(
               'checked'=> ($number->active ? "checked" : ""),
               'getaction'=>'',
               'class'=>'',
               'id'=> $number->id
            );
            $records['data'][] = [
                'checkbox'=>view('admin.shared.checkbox')->with('id',$number->id)->render(),
                'country' => $number->country,
                'number'=> $number->number,
                'setup_fee'=> $number->setup_fee,
                'allocated'=> $number->allocated ? 'Yes' : 'No',
                'active'=>view('admin.shared.switch', compact('params'))->render(),
                'action'=>view('admin.shared.actions')->with('id', $number->id)->render()
            ];
        }
        return $records;
    }

    public function import(Request $request)
    {
        $allocated_numbers = National_number::where('allocated', 1)->pluck('number')->toArray();

        if($request->file('import_file'))
        {
            set_time_limit(0);
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader)
            {
            })->get();

            if(!empty($data) && $data->count())
            {
                // $dataArray = [];

                foreach ($data->toArray() as $row)
                {
                    if(!empty($row))
                    {
                        //$dataArray[]
                        $dataArray =
                        [
                            'country' => $row['country'],
                            'number' => $row['number'],
                            'setup_fee' => $row['setup_fee'],
                            'monthly_fee' => $row['monthly_fee'],
                            // 'allocated' => (in_array($row['number'], $allocated_numbers) ? 1 : 0),
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now(),
                        ];

                        National_number::updateOrCreate(['number' => $row['number']], $dataArray);
                    }
                }
                // if(!empty($dataArray))
                // {
                //     National_number::truncate();
                //     National_number::insert($dataArray);
                //     flash('New number list successfully updated')->success();
                //     return redirect()->route('admin.number.index');
                // }
                flash('New number list updated successfully.')->success();
                return redirect()->route('admin.number.index');
            }
        }else{
            flash('File not found.')->error();
            return redirect()->route('admin.number.index');
        }   
    }
}
