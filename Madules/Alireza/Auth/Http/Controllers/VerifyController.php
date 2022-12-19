<?php

namespace Alireza\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function view(){
        return view('Auth::verify.email');
    }

    public function verify(EmailVerificationRequest $request){

        $request->fulfill();

        return redirect()->route('home.index');

    }
    public function resend(Request $request){
        $request->user()->sendEmailVerificationNotification();
        return redirect()->back()->with(['message' => 'لینک تایید حساب کاربری به ایمیل شما ارسال شد.']);
    }
}
