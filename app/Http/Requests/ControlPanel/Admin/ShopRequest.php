<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Http\Requests\MessagesTrait;
use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShopRequest extends FormRequest
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
        if ('store' === $this->segment(4)) {
            return [
                'name' => 'required|unique:shops,name'
            ];
        }

        return [
            'name' => 'required|unique:shops,name,' . $this->segment(5)
        ];
    }

    public function prepareForValidation(): void
    {

    }

    public function persist(): void
    {
        Shop::store([
            'name' => $this->name,
            'description' => $this->text,
            'address' => $this->address,
            'contacts' => $this->contacts,
        ]);
    }


    public function update(int $id): void
    {
        Shop::updateById($id, [
            'name' => $this->name,
            'description' => $this->text,
            'address' => $this->address,
            'contacts' => $this->contacts,
        ]);

    }
}
