<?php

namespace App\Http\Controllers\ControlPanel\FinCompany;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\FinCompany\OrderRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\CreditProductOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(OrderRequest $request)
    {
        $company = Auth()->user()->operator->company;
        $credit_product_orders = $request->filter();
        return view('control_panel.fin_company.orders.index', compact('credit_product_orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     */
    public function edit($id)
    {
        $order = $this->getOrder($id);
        return view('control_panel.fin_company.orders.edit' ,compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(OrderRequest $request, $id)
    {
        $order = $this->getOrder($id);
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('orders.index'));
    }

    public function archive($id)
    {
        $order = $this->getOrder($id);
        $order->creditProductOrders->is_archive = ($order->creditProductOrders->is_archive)
            ? 0 : 1;
        $order->creditProductOrders->save();
        return ResponseBuilder::jsonRedirect(route('orders.index'));
    }

    private function getOrder($id)
    {
        $company = Auth()->user()->operator->company;
        if(!$order = Order::find($id)){
            return abort(404);
        }
        if($order->creditProductOrders->fin_company_id != $company->id) {
            return abort(403);
        }
        return $order;
    }
}
