<?php

namespace App\Http\Requests\ControlPanel\FinCompany;

use App\Http\Requests\MessagesTrait;
use App\Models\Block;
use App\Models\CreditProduct;
use App\Models\ShopOperator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreditProductRequest extends FormRequest
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
            'min_sum' => 'required|numeric',
            'max_sum' => 'required|numeric',
            'min_loan_term' => 'required|numeric',
            'max_loan_term' => 'required|numeric',
            'annual_interest_rate' => 'required|numeric',
            'issuance_fee' => 'required|numeric',
            'cash_withdrawal_fee' => 'required|numeric',
            'documents' => 'nullable'
        ];
    }

    public function store()
    {
        $company = Auth()->user()->operator->company;
        $credit_product = CreditProduct::create([
            'name' => $this->name,
            'min_sum' => $this->min_sum,
            'max_sum' => $this->max_sum,
            'min_loan_term' => $this->min_loan_term,
            'max_loan_term' => $this->max_loan_term,
            'annual_interest_rate' => $this->annual_interest_rate,
            'issuance_fee' => $this->issuance_fee,
            'cash_withdrawal_fee' => $this->cash_withdrawal_fee,
            'fin_company_id' => $company->id,
        ]);
        if(isset($this->documents)) {
            $credit_product->documents()->attach($this->documents);
        }
        return $credit_product;
    }

    public function update(int $id): void
    {
        $credit = CreditProduct::find($id);
        $credit->name = $this->name;
        $credit->min_sum = $this->min_sum;
        $credit->max_sum = $this->max_sum;
        $credit->min_loan_term = $this->min_loan_term;
        $credit->max_loan_term = $this->max_loan_term;
        $credit->annual_interest_rate = $this->annual_interest_rate;
        $credit->issuance_fee = $this->issuance_fee;
        $credit->cash_withdrawal_fee = $this->cash_withdrawal_fee;

        $credit->save();

        $credit->documents()->detach();
        $credit->documents()->attach($this->documents);
    }

}

