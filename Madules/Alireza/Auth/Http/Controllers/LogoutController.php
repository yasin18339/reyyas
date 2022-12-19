<?php

namespace Alireza\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
