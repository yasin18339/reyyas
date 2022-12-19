<?php

namespace Alireza\Auth\Http\Controllers;

use Alireza\Auth\Http\Requests\RegisterRequest;
use Alireza\Auth\Services\RegisterService;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function view()
    {
        return view('Auth::register');

    }

    public function register(RegisterRequest $request, RegisterService $registerService)
    {
        $user = $registerService->generateUser($request);

        auth()->loginUsingId($user->id);

        event(new Registered($user));

        return redirect()->route('home.index');

}
}
