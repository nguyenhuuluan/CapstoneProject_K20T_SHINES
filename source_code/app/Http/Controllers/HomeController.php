<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Tag;
use Response;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $recruitments = Recruitment::where('status_id', 1)->orderBy('created_at','desc')->take(5)->get();
        return view('welcome', compact('recruitments'));
    }

    public function search(){
        //return "2";


        $term = $request->term;
        $tag = Tag::where('name', 'LIKE', '%'.$term.'%')->get();
        return $tag;
        if(count($tag) ==0){
            return 'not tag';
        }

        // $term=$request->term;
        // $data = Tag::where('name', 'LIKE', '%'.$term.'%')->take(10)->get();
        // $result = array();
        // foreach ($data as $key => $value) {
        //     $result[] = ['id'=>$value->id, 'value'=>$value->name];
        // }
        // return response()->json($result);

        // $places = ["PHP", "JS"];
        //return Response::json($places);
    }
    public function test(){
        return view('recruitments.test');
    }

}
