<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Account;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    // protected function hasTooManyLoginAttempts(Request $request)
    // {
    //     return $this->limiter()->tooManyAttempts(
    //         $this->throttleKey($request), $this->maxAttempts(), $this->decayMinutes()
    //     );
    // }

    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     throw ValidationException::withMessages([
    //         $this->username() => [trans('auth.failed')=>'Email hoặc mật khẩu không chính xác!'],
    //     ]);
    // }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

        public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    
    public function login(Request $request)
    {   

        $this->validate($request,[
         'email'=>'required|string|email|max:255',
         'password' => 'required|string|min:6',
     ]);

        // if ($this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }

        if(Auth::attempt(['username'=>$request->email, 'password'=>$request->password] )){
            return redirect('/admin/home');
        }
        return ' false';
        // $this->incrementLoginAttempts($request);

        // return $this->sendFailedLoginResponse($request);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
