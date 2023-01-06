<?php

namespace Alireza\Home\Http\Controllers;


use Alireza\Home\Repositories\HomeRepo;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(HomeRepo $homeRepo)
    {

        return view('Home::index', compact(['homeRepo']));
    }
}
