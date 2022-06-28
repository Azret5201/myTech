<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\ShopOperatorRequest;
use App\Models\FinanceCompany;
use App\Models\ShopOperator;

class CompanyOperatorController extends Controller
{
    public function index(int $id)
    {
        if(!$company = FinanceCompany::findOrFail($id)){
            return abort(404);
        }
        $operators = $company->operators;
        return view('control_panel.admin.finance_company.operators.index', compact('operators','company'));
    }

    public function create(int $id)
    {
        if(!$company = FinanceCompany::findOrFail($id)){
            return abort(404);
        }
        return view('control_panel.admin.finance_company.operators.create',compact('company'));
    }

    public function store(ShopOperatorRequest $request)
    {
        if(!$company = FinanceCompany::findOrFail($request->company_id)){
            return abort(404);
        }
        $company = $request->createUserCompany($company);
        return redirect()->route('cp.admin.finance_company.operators',[$company]);
    }

    public function edit(int $id)
    {
        if(!$operator = ShopOperator::where('id', $id)->first()){
            return abort(404);
        }
        return view('control_panel.admin.finance_company.operators.edit', compact('operator'));
    }

    public function update(ShopOperatorRequest $request, int $id)
    {
        if(!$operator = ShopOperator::where('id', $id)->first()){
            return abort(404);
        }
        $request->updateUserCompany($operator);
        return redirect()->route('cp.admin.finance_company.operators',$operator->entity_id);
    }
}
