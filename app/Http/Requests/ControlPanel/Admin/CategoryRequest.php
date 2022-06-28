<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Http\Requests\MessagesTrait;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
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
                'name' => 'required|unique:categories,name',
                'percent' => 'integer|between:0,100',
            ];
        }
        return [
            'name' => 'required|unique:categories,name,' . $this->segment(5),
            'percent' => 'integer|between:0,100',
        ];
    }

    public function persist()
    {
        Category::create([
            'name' => $this->name,
            'description' => $this->text,
            'percent' => ($this->percent > 0 || $this->percent < 100) ? $this->percent : 0,
            'parent_id' => $this->parent_id
        ]);
    }

    public function update(int $id)
    {
        Category::updateById($id, [
            'name' => $this->name,
            'description' => $this->text,
            'percent' => ($this->percent > 0 && $this->percent < 100) ? $this->percent : 0,
            'parent_id' => $this->parent_id
        ]);
    }
}
