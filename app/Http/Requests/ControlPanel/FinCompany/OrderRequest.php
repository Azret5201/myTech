<?php

namespace App\Http\Requests\ControlPanel\FinCompany;

use App\Http\Requests\MessagesTrait;
use App\Models\CreditProductOrder;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
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
        if($this->status == 3) {
            return [
                'status' => 'required|numeric',
                'status_text' => 'required|string|max:255',
            ];
        }

        if(($this->status == 1)||($this->status == 2)){
            return [
                'status' => 'required|numeric',
            ];
        }

        return [
                'filter' => 'nullable|numeric'
        ];
    }

    public function update(int $id): void
    {
        $credit_product_order = CreditProductOrder::where('order_id',$id)->first();
        $credit_product_order->status_id = $this->status;
        $credit_product_order->status_text = $this->status_text;
        $credit_product_order->save();
    }

    public function filter()
    {
        $company = Auth()->user()->operator->company;
        if($this->filter == 1){
            return $company->creditProductOrders->where('is_archive', 0);
        }
        if($this->filter == 2) {
            return $company->creditProductOrders->where('is_archive', 1);
        }
        return $company->creditProductOrders;
    }
}
