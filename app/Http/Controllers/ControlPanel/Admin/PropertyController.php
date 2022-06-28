<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\ProductRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\DefaultProperty;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        DefaultProperty::checkOrCreate($request->prop);
        return ResponseBuilder::addOption('#select2Multiple', $request->prop);
    }

}
