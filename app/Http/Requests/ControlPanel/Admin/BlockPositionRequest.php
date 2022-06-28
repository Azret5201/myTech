<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Http\Requests\MessagesTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BlockPositionRequest extends FormRequest
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
            'positions' => 'required',
        ];

    }
}
