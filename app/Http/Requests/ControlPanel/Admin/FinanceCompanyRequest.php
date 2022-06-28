<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Http\Requests\MessagesTrait;
use App\Models\FinanceCompany;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FinanceCompanyRequest extends FormRequest
{
    use MessagesTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::guard('web')->check() && 1 === Auth::guard('web')->user()->type_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'site' => 'nullable|string',
            'instagram' => 'nullable|string',
        ];

    }

    public function store()
    {
        FinanceCompany::create ([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'site' => $this->site,
            'instagram' => $this->instagram,
        ]);
    }

    public function update(int $id)
    {
        FinanceCompany::updateById($id,[
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'site' => $this->site,
            'instagram' => $this->instagram,
        ]);
    }
}
