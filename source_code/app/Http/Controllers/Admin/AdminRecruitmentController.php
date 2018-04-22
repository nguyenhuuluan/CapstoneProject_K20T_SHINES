<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recruitment;
use Mail;
use GuzzleHttp\Client;


class AdminRecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $recruitments = Recruitment::where('status_id', '1')->orWhere('status_id', '2')->get();
        return view ('admin.recruitments.index',compact('recruitments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $recruitments = Recruitment::where('status_id', 8)->get();
        // return view ('admin.recruitments.approve', compact('recruitments'));
    }

    public function approve()
    {
        $recruitments = Recruitment::where('status_id', 8)->get();
        return view ('admin.recruitments.approve', compact('recruitments'));

    }

    public function setApproveRecruitment($recruitmentID){
        $recruitment = Recruitment::Where('id', $recruimentID)->first();

        $recruitment->status_id = 1;

        $recruitment->save();

        //return '231';
        return $recruitment;  

    }


    public function approveRecruitment($recruitmentID)
    {   
    // $this->createRepresentative($companyID);
    // return response()->json(['isSuccess' => true]);

        $recruitment = Recruitment::where('id', $recruitmentID)->first();

        $recruitment->status_id = 1;
        $recruitment->save();


  //  return $repre;

        return response()->json(['isSuccess' => true]);

    }

    public function feedback($recruitmentID, $message){

        $recruitment = Recruitment::where('id', $recruitmentID)->first();

        $company = $recruitment->company()->first();

        $representative = $recruitment->company()->first()->representatives()->first();

        return $representative;

        // return view ('admin.recruitments.email-feedback', compact('recruitment','company','representative','message'));

        Mail::send('admin.recruitments.email-feedback', ['company' => $company, 'representative' => $representative, 'recruitment' => $recruitment, 'message1' => $message],  function ($message) use($representative)
        {
           $message->to($representative['email'])->subject('Phản hồi tin tuyển dụng');
       });

        return response()->json(['OK' => 'OK'], 200);
    }

   





    public function setActiveRecruitment($recruitment_id){
        $recruitment = Recruitment::Where('id', $recruitment_id)->first();

        if ($recruitment->status_id != 1) {
           $recruitment->status_id = 1;
       }else {
           $recruitment->status_id = 2;
       }

       $recruitment->save();     
       return $recruitment;
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
    public function show($slug)
    {
        //
        $recruitment = Recruitment::findBySlugOrFail($slug);
        return view('admin.recruitments.preview',compact('recruitment'));
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
        Recruitment::findOrFail($id)->update($request->all());
        return redirect()->back();
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
