<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('control_panel.admin.dashboard.index');
    }
}
