<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Blog;
use App\Photo;
use App\Tag;
use DataTables;
use Auth;


class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->can('blogs.view')){
            return view('admin.blogs.index');
        }
        else{return view('errors.admin_auth');}

    }
    function getdata()
    {
      // $blogs = Blog::select('id', 'title', 'content', 'created_at');
        if(Auth::user()->can('blogs.view')){
            $blogs = Blog::all();
            return DataTables()::of($blogs)
            ->addColumn('tag', function($blog)
            {
                $tmp = '<div style="display:grid; grid-template-columns: repeat(2,1fr);grid-gap: 5px">';
                foreach ($blog->tags as $tag)
                {
                    $tmp .=  '<div style="display:grid"><span class="label label-default">'.$tag->name.'</span></div>';
                }
                $tmp .= '</div>';
                return $tmp;
            })       
            ->addColumn('action', function($blog){
                $tmp = '<div style="display:grid; grid-template-columns: repeat(3,1fr);grid-gap: 5px">';
                if(Auth::user()->can('blogs.update')){
                    $tmp .= '<a href="'.route('blogs.edit',$blog->slug).'" class="btn btn-xs btn-primary edit" id="'.$blog->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
                }
                if(Auth::user()->can('blogs.delete')){
                    $tmp .='<a href="#" class="btn btn-xs btn-danger delete" id="'.$blog->slug.'"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>';
                }
                $tmp .= '</div>';
                return $tmp;
                
            })
            ->rawColumns(['tag', 'action'])
            ->make(true);
        }
        else{return response()->json('error',400);}

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('blogs.create')){
            return view('admin.blogs.create');
        }
        else{return view('errors.admin_auth');}

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
            'imgBlog'=>'required',
            'content'=>'required',
        ]);

        $tags1 = explode(',', request('tags'));
        $img = $request->imgBlog;
        list($type, $img) = explode(';', $img);
        list(, $img)      = explode(',', $img);
        $img = base64_decode($img);
        $imageName = time().'_'.$request->imgText;

        $data = [
            'title'=>request('title'),
            'description'=>request('description'),
            'content'=>request('content'),
            'account_id'=>auth()->id(),
            'photo'=>$imageName,
        ];

        switch (request('submitbutton'))
        {
            case 'Xem trước':
            foreach ($tags1 as $key => $value) 
            {
                $tags2[]= $value;
            }
            return view('blogs.preview', compact('data', 'tags2') );

            case 'Đăng bài':
            if(Auth::user()->can('blogs.create')){
                /*Save ava image*/
                if(file_put_contents('blogs/ava/'.$imageName, $img))
                {
                    $blog = Blog::create($data);
                    /*Save tagss*/
                    foreach ($tags1 as $key => $value) {
                        if(count(Tag::Where('name',$value)->get()) !=0)
                            {
                                $blog->tags()->save(Tag::where('name',$value)->first());
                            }
                            else
                            {
                                $tg = Tag::create(['name'=>$value]);
                                $blog->tags()->save($tg);
                            }
                        }
                        return redirect(route('blogs.index'))->with('message','Tạo Blog thành công!');
                    }else{
                //Lưu Ảnh không thành công
                        return redirect()->back()->with('error', 'Lưu ảnh diện không thành công.');
                    }
             // $file->move('blogs/ava', $fileName);

                }
                else{return view('errors.admin_auth');}
            }
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
        if(Auth::user()->can('blogs.update')){

            $blog = Blog::findBySlugOrFail($id);
            $blog['tags'] = implode(',', $blog->tags->pluck('name')->all());
            return view('admin.blogs.edit',compact('blog'));
        }else{return view('errors.admin_auth');}

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
        // return $request->all();

       $this->validate($request, [
        'title'=>'required',
        'description'=>'required',
        'content'=>'required',
    ]);

       $blog = Blog::findBySlugOrFail($id);
       $tags1 = explode(',', request('tags'));

       $data = [
        'title'=>request('title'),
        'description'=>request('description'),
        'content'=>request('content'),
    ];
    switch (request('submitbutton'))
    {
        case 'Xem trước':
        foreach ($tags1 as $key => $value) 
        {
            $tags2[]= $value;
        }
        return view('blogs.preview', compact('data', 'tags2') );

        case 'Cập nhật':
        if(Auth::user()->can('blogs.update')){
            // if($file = $request->file('imgInp')){
            //     $fileName = time().'_'.$file->getClientOriginalName(); 
            //     $data['photo'] = $fileName;
            //     $file->move('blogs/ava', $fileName);

            //     // unlink(base_path().'/public_html/'.$blog->photo);
            //     unlink(public_path().$blog->photo);
            // }
            /*Save ava image*/
            if($request->imgText && $request->imgBlog){
                $tags1 = explode(',', request('tags'));
                $img = $request->imgBlog;
                list($type, $img) = explode(';', $img);
                list(, $img)      = explode(',', $img);
                $img = base64_decode($img);
                $imageName = time().'_'.$request->imgText;
                // return var_dump($imageName);
                $data['photo'] = $imageName;
                //Chay tren host
                // unlink(base_path().'/public_html/'.$blog->photo);
                unlink(public_path().$blog->photo);

                if(!file_put_contents('blogs/ava/'.$imageName, $img)){
                    return redirect()->back()->with('error', 'Lưu ảnh diện không thành công.');
                }
            }
            $blog->update($data);
            /*Save tagss*/
            $blog->tags()->detach();
            foreach ($tags1 as $key => $value) {
                if(count(Tag::Where('name',$value)->get()) !=0)
                    {
                        $blog->tags()->save(Tag::where('name',$value)->first());
                    }
                    else
                    {
                        $tg = Tag::create(['name'=>$value]);
                        $blog->tags()->save($tg);
                    }
                }
                /*Save ava image*/
                return redirect(route('blogs.index'))->with('message','Cập nhật Blog thành công!');
            }
            else{return view('errors.admin_auth');}
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Auth::user()->can('blogs.delete')){
            $blog =Blog::findBySlugOrFail($request->slug);
            if($blog->delete())
            {
                    //chay trên host
                    // unlink(base_path().'/public_html/'.$student->photo);
                unlink(public_path().$blog->photo);
                return response()->json('success');
            }
            else{
               return response()->json('error',400);
           }
       }else{return response()->json('error',400);}

   }
}
