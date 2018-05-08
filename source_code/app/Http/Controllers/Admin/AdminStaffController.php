<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Permission;
use Auth;
use DataTables;

class AdminStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('accounts.staff'))
            {
                $staffs = Staff::with('account.permissions')->get();
                return view('admin.accounts.staff', compact('staffs'));
            }
            return redirect(route('admin.home'));
        }

/*        function getdata()
        {
            if(Auth::user()->can('accounts.staff'))
                {
                    $staffs = Staff::with('account.permissions')->get();
                    return DataTables()::of($staffs)->addColumn('action', function($staff){
                        return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$staff->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                        <a href="#" class="btn btn-xs btn-danger delete" id="'.$staff->id.'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        ';
                    })
                    ->addColumn('status', function($staff)
                    {
                        return '<input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" value="'.$staff->id.'"/>';
                    })
                    ->addColumn('permissions', function($staff)
                    {
                        $tmp = '';
                            foreach ($staff->account->permissions as $permission)
                            {
                                $tmp .=  '<span class="label label-default">'.$permission->name.'</span>';
                            }
                            return $tmp;
                    })

                    ->rawColumns(['status', 'action', 'permissions']) 
                    ->make(true);
                }
                else{return response()->json(['error' => 'Error msg'], 404);}

            }*/

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
        $staff = Staff::with('account.permissions')->find($id);
        $permissions = Permission::all();
        return view('ajax.permissionList', compact('staff', 'permissions'));
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
