<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Blog;


class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return '123';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'title'=>'required',
            'description'=>'required',
            'imgInp'=>'required',
            'content'=>'required',
        ]);

        $tags = explode(',', request('tags')); 
        $data = [
            'title'=>request('title'),
            'description'=>request('description'),
            'content'=>request('content'),
            'account_id'=>auth()->id(),
        ];
        switch (request('submitbutton')) {
            case 'Xem trước':
            foreach ($tags as $key => $value) {
                $tags2[]= $value;
            }
            return view('blogs.preview', compact('data', 'tags2') );

            case 'Đăng bài':
            $blog = Blog::create($data);

            return redirect(route('blogs.index'))->with('message','Tạo Blog thành công!');
        }

        // $file = $request->file('imgInp');
        // return $file;
        // return $request->all();
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
    public function destroy($id)
    {
        //
    }
}
