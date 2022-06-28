<?php

namespace App\Http\Controllers\ControlPanel\FinCompany\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\CompanyLoginRequest;
use App\Http\Response\ResponseBuilder;
use Illuminate\Http\Request;

class CompanyLoginController extends Controller
{
    public function getLogin()
    {
        return view('control_panel.auth.company_admin_login');
    }

    public function postLogin(CompanyLoginRequest $request)
    {
        if (false === $request->checkAuth()) {
            return ResponseBuilder::jsonAlertError('Ошибка', 'Логин или пароль не верные', 401);
        }

        return ResponseBuilder::jsonRedirect($request->getRedirectUrl());

    }

    public  function home()
    {
        return view('control_panel.company_admin.index');
    }

}
