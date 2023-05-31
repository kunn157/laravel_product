<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPassword\ForgetPassword;
use App\Http\Requests\ForgetPassword\ForgetPasswordForm;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use DB;
use Mail;
use Hash;
use Illuminate\Support\Str;
use App\Jobs\SendEmail;
class ForgotPasswordController extends Controller
{
       /**
       * Write code on Method
       *
       * @return \Illuminate\Http\Response
       */
      public function showForgetPasswordForm()
      {
         return view('user.forgetpassword.forgetPassword');
      }

      /**
       * submitForgetPasswordForm
       *@param  App\Http\Requests\ForgetPassword\ForgetPasswordForm;  $request
       *@return \Illuminate\Http\Response
       *
       */
      public function submitForgetPasswordForm(ForgetPasswordForm $request)
      {
          $token = $request ->email.Str::random(64);
          DB::table('password_resets')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);
          Mail::send('user.forgetpassword..emailForgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
          return back()->with('message', __("messages.submitForgetPasswordForm"));
      }
      /**
       * Write code on Method
       *
       * @return \Illuminate\Http\Response
       */
      public function showResetPasswordForm($token) {
         return view('user.forgetpassword.forgetPasswordLink', ['token' => $token]);
      }

        /**
     * submitResetPasswordForm
     *
     * @param  App\Http\Requests\ForgetPassword\ForgetPassword;  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
      public function submitResetPasswordForm(ForgetPassword $request)
      {
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token])->first();
          if(!$updatePassword){
              return back()->withInput()->with('error', __("messages.errorsubmitResetPasswordForm"));
          }
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
          return redirect('/login')->with('message', __("messages.submitResetPasswordForm"));
      }
}
