<?php

namespace App\Http\Requests\ControlPanel\Client;

use App\Http\Requests\MessagesTrait;
use App\Models\CreditProduct;
use App\Models\CreditProductOrder;
use App\Models\FileUpload;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\File\CreateFileUploadService;
use App\Services\File\Enum\Disk;
use App\Services\File\Interfaces\OrderMediaClass;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    use MessagesTrait;

    public function rules(): array
    {
        if(!Auth()->user()) {
            return [
                'phone' => 'required|numeric',
                'credit_product_id' => 'required|numeric',
                'name' => 'required|string',
                'email' => 'required|email',
                'files' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
            ];
        }
        if(Auth()->user()->type_id != 5){
            return [
                'phone' => 'required|numeric',
                'credit_product_id' => 'required|numeric',
                'name' => 'required|string',
                'email' => 'required|email',
                'files' => 'required',
            ];
        }
        return [
            'phone' => 'required|numeric',
            'credit_product_id' => 'required|numeric',
            'files' => 'required',
        ];
    }

    public function store()
    {
        $user = Auth()->user();
        $shops = session('cart');
        $credit_product = CreditProduct::find($this->credit_product_id);
        $arr = [
            'id' => $credit_product->id,
            'name' => $credit_product->name,
            'fin_company_id' => $credit_product->fin_company_id,
            'min_sum' => $credit_product->min_sum,
            'max_sum' => $credit_product->max_sum,
            'min_loan_term' => $credit_product->min_loan_term,
            'max_loan_term' => $credit_product->max_loan_term,
            'annual_interest_rate' => $credit_product->annual_interest_rate,
            'issuance_fee' => $credit_product->issuance_fee,
            'cash_withdrawal_fee' => $credit_product->cash_withdrawal_fee,
        ];

        $order = new Order;
        $order->name = ($this->name) ? $this->name : $user->name;
        $order->client_id = ($user) ? $user->id : NULL;
        $order->email = ($this->email) ? $this->email : $user->email;
        $order->phone = $this->phone;
        $order->credit_products = json_encode($arr);
        $order->total = session('total');
        $order->save();
        $product_options = [];
        $files = $this->file('files');
        foreach($files as $file){
                $config = new OrderMediaClass($order->id, $file->getClientOriginalName(), ['100', '300'], '');
                $disk =  Disk::LOCAL();
                $fileUpload = new CreateFileUploadService();
                $fileUpload->add($file, $disk, $config);
            }

        foreach ($shops as $products) {
            foreach ($products as $product) {
                $order_product = new OrderProduct;
                $order_product->shop_id = key($shops);
                $order_product->order_id = $order->id;
                $order_product->product_id = key($products);
                $order_product->price = $product['price'];
                $order_product->amount = $product['quantity'];
                $order_product->save();

                $product_options[] = [
                    'shop_id' => key($shops),
                    'price' => $product['price'],
                    'amount' => $product['quantity'],
                    'product_id' => key($products),
                ];
            }
        }

        foreach ($shops as $products) {
            $fin_company = CreditProduct::find(key($products))->company;
            $credit_product = new CreditProductOrder;
            $credit_product->order_id = $order->id;
            $credit_product->product_id = key($products);
            $credit_product->fin_company_id = $fin_company->id;
            $credit_product->status_id = 1;
            $credit_product->product_options = json_encode($product_options);
            $credit_product->save();
        }
        session()->forget('cart');
        session()->forget('total');
    }
}
