<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.contents.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('admin.content.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.content.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('admin.content.index');
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
            $content = Content::findOrFail($id);
            return view('admin.pages.contents.edit', ['content' => $content]);
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
        // $rules = [
        //     'content' => 'required',
        // ];

        // $this->validateForm($request->all(),$rules);

        $content = Content::find($id);

        if(!empty($content)){
            $content->content = $request->content;

            if($content->save()){
                flash('Content page updated successfully.')->success();
            }
            else{
                flash('Something went wrong.')->error();
            }
        }
        else{
            flash('Content page not found.')->error();
        }

        return redirect()->route('admin.content.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->ajax()){
            return response()->json([]);
        }else{
            return redirect()->route('admin.content.index');
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));

        $count = Content::where('id', '<>', 0);
        if($search != ''){
            $count->where(function($query) use ($search){
                $query->where("name", "like", "%{$search}%");
            });
        }
        $count = $count->count();

        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records['data'] = array();
        $pages = Content::where('id', '<>', 0)->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        if($search != ''){
            $pages->where(function($query) use ($search){
                $query->where("name", "like", "%{$search}%");
            });
        }
        $pages = $pages->get();
        foreach ($pages as $page) {
            $page_url = env('APP_URL') . $page->slug;
            $records['data'][] = [
                'name' => $page->name,
                'page' => '<a href="' . $page_url .'" target="_blank" >' . $page_url . '</a>',
                'action'=>view('admin.shared.actions')->with('id', $page->id)->render()
            ];
        }
        return $records;
    }

    public function upload_ck_file(Request $request) {
        if ($request->hasFile('upload')) {
            // ------ Process your file upload code -------
            // $filen = $_FILES['upload']['tmp_name'];
            // $path_parts = pathinfo($_FILES["file"]["name"]);
            // $extension = $path_parts['extension'];
            // $filename = md5(time() . rand()) . '.' . $extension;
            // $con_images = SITE_UPD . 'ckeditor/' . $filename;
            // move_uploaded_file($filen, FCPATH . $con_images);
            // $url = base_url($con_images);
            $path = $request->file('upload')->store('ckeditor');
            $url = asset('storage/app/' . $path);
            /*$url = $con_images;*/

            $funcNum = $_GET['CKEditorFuncNum'];
            // Optional: instance name (might be used to load a specific configuration file or anything else).
            $CKEditor = $_GET['CKEditor'];
            // Optional: might be used to provide localized messages.
            $langCode = $_GET['langCode'];

            // Usually you will only assign something here if the file could not be uploaded.
            $message = '';
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
        }
    }
}
