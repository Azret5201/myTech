<?php

namespace App\Http\Requests\ControlPanel;

//use App\Http\Controllers\ControlPanel\HomeController;
use App\Http\Controllers\ControlPanel\Admin\HomeController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'login' => 'required|email',
            'password' => 'required'
        ];
    }

    public function checkAuth(): bool
    {
        $authResult = Auth::guard('web')->attempt([
            'email' => $this->input('login'),
            'password' => $this->input('password')
        ]);

        if ($authResult) {
            $this->initCustomer();
            return true;
        }

        return false;
    }

    public function getRedirectUrl(): string
    {
        return route('cp.admin.home');
    }

    private function initCustomer(): void
    {
        $customer = Auth::guard('web')->user();
        session()->put('user_type', $customer->type_id);
    }

}
