<?php

namespace Alireza\Auth\Http\Controllers;

use Alireza\Auth\Http\Requests\PasswordUpdateRequest;
use Alireza\Auth\Http\Requests\SendEmailPasswordRecoveryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetController extends Controller
{
    public function view(){

        return view('Auth::password.send-email');
    }
    public function sendEmail(SendEmailPasswordRecoveryRequest $request){


        $reset = Password::sendResetLink($request->only('email'));
        return $reset === Password::RESET_LINK_SENT ?
         back()->with(['message' => 'لینک بازیابی ایمیل با موفقیت ارسال شد'])
            : back()->withErrors(['error' => 'یک مشکلی در سیستم رخ داده لطفا مجددا تلاش کنید']);



    }
    public function reset (Request  $request)
    {
        $token = $request->token;
        $email = $request->email;
        return view('Auth::password.reset', compact(['token', 'email']));

    }
    public function update(PasswordUpdateRequest  $request)
    {
        $reset = Password::reset($request->only('token', 'email', 'password', 'password_confirmed'),
        static function ($user, $password){
            $user->forceFill(['password' => bcrypt($password)])->setRememberToken(Str::random(60));
            $user->save();
            event(new ResetPassword($user));

        }

        );

        return $reset === Password::PASSWORD_RESET ?
            redirect()->route('login')->with(['success_reset_password' =>'رمز عبور با موفقیت تغییر کرد.'])
            : back()->withErrors(['error'=>'مشکلی در سیستم رخ داد لطفا مجددا تلاش کنید.']);


    }
}
