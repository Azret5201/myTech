<?php

namespace App\Http\Controllers\ControlPanel\FinCompany;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControlPanel\Admin\ShopOperatorController;
use App\Http\Requests\ControlPanel\FinCompany\CreditProductRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\CreditProduct;
use App\Models\Document;
use App\Models\FinanceCompany;
use App\Models\ShopOperator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreditProductController extends Controller
{
    //
    public function index()
    {
        $company = Auth()->user()->operator->company;
        $credit_products = CreditProduct::where('fin_company_id',$company->id)->get();
        return view('control_panel.fin_company.credit_products.index',compact('credit_products'));
    }

    public function create()
    {
        $documents = Document::all();
        return view('control_panel.fin_company.credit_products.create', compact('documents'));
    }

    public function store(CreditProductRequest $request): JsonResponse
    {
        $request->store();
        return ResponseBuilder::jsonRedirect(route('cp.fin.credit_products.index'));
    }

    public function edit(int $id)
    {
        $company = Auth()->user()->operator->company;
        if(!$product = CreditProduct::find($id)){
         return abort(404);
        }
        if($company->id != $product->fin_company_id) {
            return abort(403);
        }

        $documents = $company->documents;
        return view('control_panel.fin_company.credit_products.edit' ,compact('product','documents'));
    }

    public function update(CreditProductRequest $request, int $id)
    {
        $company = Auth()->user()->operator->company;
        if(!$product = CreditProduct::find($id)){
            return abort(404);
        }
        if($company->id != $product->fin_company_id) {
            return abort(403);
        }
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('cp.fin.credit_products.index'));
    }
}
