<?php

namespace App\Http\Controllers\ControlPanel\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\LoginRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class LoginController extends Controller
{

    public function getLogin(): void
    {
        echo view('control_panel.auth.login');
    }

    public function postLogin(LoginRequest $request): JsonResponse
    {
        if (false === $request->checkAuth()) {
            return ResponseBuilder::jsonAlertError('Ошибка', 'Логин или пароль не верные', 401);
        }

        return ResponseBuilder::jsonRedirect($request->getRedirectUrl());

    }

    public function logout()
    {
    }
}
