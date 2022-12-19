<?php

namespace Alireza\Auth\Http\Controllers;
use Alireza\Auth\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class  LoginController extends Controller
{
    public function view()
    {
        return view('Auth::login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('home.index');
//            to_route('home.index');
        }
        return redirect()->back()->withErrors(['data_problem' => 'اطلاعات درست نبوده!']);

    }
}
