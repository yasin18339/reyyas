<?php

namespace Alireza\Panel\Http\Controllers;

use Alireza\Panel\Models\Panel;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index(){
        $this->authorize('index', Panel::class);
        return view('Panel::index');
    }
}
