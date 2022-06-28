<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Http\Requests\MessagesTrait;
use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BrandRequest extends FormRequest
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
                'name' => 'required|unique:brands,name'
            ];
        }

        if ('mass_store' === $this->segment(4)) {
            return [
                'brands' => 'required'
            ];
        }

        return [
            'name' => 'required|unique:brands,name,' . $this->segment(5)
        ];
    }

    public function persist(): void
    {
        Brand::store([
            'name' => $this->name,
            'description' => $this->text
        ]);
    }

    public function massStore(): void
    {
        $names = explode("\r\n", $this->brands);
        Brand::addArrayName($names);
    }


    public function update(int $id): void
    {
        Brand::updateById($id, [
            'name' => $this->name,
            'description' => $this->text
        ]);

    }
}
