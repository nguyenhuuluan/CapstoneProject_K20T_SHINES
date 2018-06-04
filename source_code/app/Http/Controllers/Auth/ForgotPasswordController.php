<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mail;

// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Account;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest');
    }

    public function forgotPassword()
    {
     return View('auth.passwords.reset');
   }

   public function sendForgotPassword(Request $request)
   {
    // return $request->all();

     $request->validate([
      'account' => 'required|email|exists:accounts,username',
      'g-recaptcha-response' => 'required|recaptcha',
    ],[
      'account.required'=>'Vui lòng nhập Email.',
      'account.email'=>'Vui lòng nhập Email đúng định dạng.',
      'account.exists'=>'Email không tồn tại trong hệ thống.',
      'g-recaptcha-response.required' => 'Form quên mật khẩu không dành cho robot. Vui lòng Refresh lại trang.',
      'g-recaptcha-response.recaptcha' => 'Form quên mật khẩu không dành cho robot. Vui lòng Refresh lại trang.',
    ]);
     
     $account = Account::where('username' , '=', trim($request->account))->first();
     $token = str_random(20) . 'rEsEtPass' .str_random(20);
     $account->remember_token = $token;
     $account->save();

     $recivedMailDate = date("d/m/Y h:i:sa");

     Mail::send('account.email-reset-password',
       ['account' => $account, 'recivedMailDate' => $recivedMailDate],
       function ($message) use($account){
         $message->to($account['username'])->subject('Cập nhật lại mật khẩu');
       });   

     $request->session()->flash('send-email-success', 'Đã gửi thông tin cập nhật mật khẩu đến <strong> '. $account['username'] .' </strong>');
     return redirect()->back();
   }

   public function resetPasswordForm($token)
   {
    $acc = Account::where('remember_token', '=', $token)->first();

    if (!$acc) {
      return view('errors.404');
    }
    return view('representative.confirm')->with(compact('acc'));
  }

  public function sendResetPassword(\App\Http\Requests\AccountRequest $request)
  {
    $acc = Account::where('id', $request['account_id'])->first();
    $acc->password = bcrypt($request['password']);
    // $acc->status_id = 5;
    $acc->remember_token = '';
    $acc->save();
    return redirect()->route('representative.update-success');     
  }




}
