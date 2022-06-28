<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Enum\UsersType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\FinanceCompanyRequest;
use App\Http\Requests\ControlPanel\Admin\ShopOperatorRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\FinanceCompany;
use App\Models\ShopOperator;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FinanceCompanyController extends Controller
{
    public function index()
    {
        $companies = FinanceCompany::all();
        return view('control_panel.admin.finance_company.index', compact('companies'));
    }

    public function create()
    {
        return view('control_panel.admin.finance_company.create');
    }

    public function store(FinanceCompanyRequest $request)
    {
        $request->store();
        return ResponseBuilder::jsonRedirect(route('cp.admin.finance_company.index'));
    }

    public function edit(int $id)
    {
        if(!$company = FinanceCompany::where('id',$id)->first()){
            return abort(404);
        }
        return view( 'control_panel.admin.finance_company.edit', compact(['company']));
    }

    public function update(FinanceCompanyRequest $request, int $id)
    {
        if(FinanceCompany::find($id)){
            return abort(404);
        }
        $request->update($id);
        return redirect()->route('cp.admin.finance_company.index');
    }

}
