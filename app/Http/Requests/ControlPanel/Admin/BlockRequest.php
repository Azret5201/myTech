<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Http\Requests\MessagesTrait;
use App\Models\Block;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BlockRequest extends FormRequest
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
            'position' => 'required|integer',
            'display' => 'nullable|string',
            'products' => 'required',
        ];

    }

    public function store()
    {
        $display = ($this->display)? 1 : 0 ;
        $block = Block::create([
            'name' => $this->name,
            'position' => $this->position,
            'display' => $display,
        ]);

        $block->products()->attach($this->products);
        return $block;
    }

    public function update(int $id): void
    {
        $display = ($this->display)? 1 : 0 ;

        $block = Block::find($id);
        $block->name = $this->name;
        $block->position = $this->position;
        $block->display = $display;
        $block->save();

        $block->products()->detach();
        $block->products()->attach($this->products);
    }

}
