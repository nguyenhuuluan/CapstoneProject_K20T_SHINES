<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\Category;
use App\Recruitment;
use App\Section;
use App\Company;

use App\Account;

class RepresentativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentcompID = Auth::user()->representative->company->id;
        $recruitcount = Recruitment::where('company_id', $currentcompID)->count();
        $statusCompany = Company::where('id', $currentcompID)->pluck('status_id');

        // $totalapplied = Recruitment::where('company_id', $currentcompID)->

        $totalrepresentative = Auth::user()->representative->company->representatives()->count();
        $studentview = Recruitment::where('company_id', $currentcompID)->pluck('number_of_view')->sum();

        $anonymousview = Recruitment::where('company_id', $currentcompID)->pluck('number_of_anonymous_view')->sum();

         return view('representative.index')->with(compact('recruitcount', 'studentview', 'anonymousview','totalrepresentative','statusCompany'));
    }

    public function resetPassword($token)
    {
        $acc = Account::where('remember_token', '=', $token)->first();

        if (!$acc) {
            return view('layouts2.custom-error-message')->with('errorMessage', 'Địa chỉ hiện tại không tồn tại');
        }

        return view('representative.confirm')->with(compact('acc'));
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
    public function destroy($id)
    {
        //
    }
}
