<?php

namespace App\Http\Requests\ControlPanel\FinCompany;

use App\Http\Requests\MessagesTrait;
use App\Models\CreditProduct;
use App\Models\Document;
use App\Models\ShopOperator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DocumentRequest extends FormRequest
{
    use MessagesTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::guard('web')->check() && 3 === Auth::guard('web')->user()->type_id;
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
           'description' => 'required|string',
        ];
    }

    public function store()
    {
        $company = Auth()->user()->operator->company;
        Document::create([
            'name' => $this->name,
            'description' => $this->description,
            'fin_company_id' => $company->id,
        ]);

    }

    public function update(int $id): void
    {
        $document = Document::find($id);
        $document->name = $this->name;
        $document->description = $this->description;
        $document->save();
    }

}
