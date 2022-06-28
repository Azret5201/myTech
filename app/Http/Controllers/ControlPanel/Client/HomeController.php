<?php

namespace App\Http\Controllers\ControlPanel\Client;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $blocks = Block::with('products.users')->get();

        return view('layouts.includes.main', compact('blocks'));
    }
}
