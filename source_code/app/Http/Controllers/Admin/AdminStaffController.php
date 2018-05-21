<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Permission;
use Auth;
use DataTables;
use DB;
use Validator;
use App\Account;


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
        $validation = Validator::make($request->all(),
          [
            'name' => 'required',
            'phone'  => 'required|max:20',
            'email'  => 'required|email|unique:staff,email',
            'password'  => 'required',
            'account'  => 'required|unique:accounts,username',
        ],[
            'name.required'=>'Tên không được bỏ trống!',
            'email.required'=>'Email không được bỏ trống!',
            'phone.required'=>'SĐT không được bỏ trống!',
            'phone.max'=>'SĐT tối đa 20 ký tự!',
            'account.required'=>'Tài khoản đăng nhập không được bỏ trống!',
            'account.unique'=>'Tài khoản đăng nhập này đã tồn tại!',
            'email.unique'=>'Email này đã tồn tại!',
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {   
            $account = Account::create([
                'username'=>$request->account,
                'password' => bcrypt($request->password),
                'status_id' => 5,
            ]);
            $account->roles()->attach(2);
            $staff = new Staff;
            $staff->name = $request->name;
            $staff->phone = $request->phone;
            $staff->email = $request->email;
            $staff->account_id = $account->id;
            $staff->save();
            $staff['username']=$account->username;
            $success_output = $staff;
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
        );
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type)
    {
        if($type == 'permission')
        {
            $staff = Staff::with('account.permissions')->find($id);
            $permissions = Permission::all();
            return view('ajax.permissionList', compact('staff', 'permissions'));
        }elseif ($type == 'profile') {
            $staff = Staff::with('account')->find($id);
            return view('ajax.staffUpdate', compact('staff'));
        }else{
            return response()->json('error', 400);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   

        $staff = Staff::with('account')->findOrFail($request->staff_id);
        if($request->button_action =='permission')
        {
            $staff->account->permissions()->sync($request->permission);
            $output = array(
                'success'   =>  $staff,
                'type'      =>  'permission',
            );
            return $output;
        }elseif($request->button_action =='profile')
        {
           $validation = Validator::make($request->all(),
              [
                'name' => 'required',
                'phone'  => 'required|max:20',
                'email'  => 'required|email|unique:staff,email,'.$request->staff_id,
                'account'  => 'required|unique:accounts,username,'.$staff->account->id,
            ],[
                'name.required'=>'Tên không được bỏ trống!',
                'email.required'=>'Email không được bỏ trống!',
                'phone.required'=>'SĐT không được bỏ trống!',
                'phone.max'=>'SĐT tối đa 20 ký tự!',
                'account.required'=>'Tài khoản đăng nhập không được bỏ trống!',
                'account.unique'=>'Tài khoản đăng nhập này đã tồn tại!',
                'email.unique'=>'Email này đã tồn tại!',
            ]);

           $error_array = array();
           $success_output = '';
           if ($validation->fails())
           {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {
            $staff->name = $request->name;
            $staff->phone = $request->phone;
            $staff->email = $request->email;
            $staff->save();
            $staff->account()->update(['username'=>$request->account]);
            $success_output = $staff;
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'type'      =>  'profile',
        );
        return $output;
    }elseif($request->button_action =='active')
    {   
        if($request->status_id ==5)
        {
            $staff->account()->update(['status_id'=> 6 ]);
        }elseif($request->status_id ==6)
        {
            $staff->account()->update(['status_id'=> 5 ]);
        }
        $output = array(
            'success'   =>  $staff,
            'type'      =>  'active',
        );
        return $output;
    }else
    {
        return response()->json('error', 400);
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
        if(Staff::findOrFail($id)->account()->delete())
            {return response()->json('success', 200);}
            else{return response()->json('error', 400);}
        }
    }
