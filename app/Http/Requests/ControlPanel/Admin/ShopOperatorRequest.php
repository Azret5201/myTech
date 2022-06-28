<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Enum\UsersType;
use App\Http\Requests\MessagesTrait;
use App\Models\FinanceCompany;
use App\Models\Shop;
use App\Models\ShopOperator;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopOperatorRequest extends FormRequest
{
    use MessagesTrait;

    protected $operatorUserId;
    protected $operatorShopId;
    protected $operatorId;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('web')->check() && 1 === Auth::guard('web')->user()->type_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ('store' === $this->segment(5)) {
            return [
                'name' => 'required|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:15',
            ];
        }

        return [
            'name' => 'required|unique:users,name,' . $this->operatorUserId,
            'email' => 'required|email|unique:users,email,' . $this->operatorUserId,
        ];
    }

    public function prepareForValidation(): void
    {
        $shopOperator = ShopOperator::where('id', $this->segment(6))->first();
        $this->shop_admin = $this->shop_admin ? 1 : 0;
        $this->shop_operator_active = $this->shop_operator_active ? 1 : 0;
        $this->operatorUserId = $shopOperator->user_id ?? null;
        $this->operatorShopId = $shopOperator->shop_id ?? null;
        $this->operatorId = $shopOperator->id ?? null;
    }

    public function persist(Shop $shop)
    {
        $user = User::store([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'type_id' => UsersType::SHOP(),
            'active' => $this->shop_operator_active,
        ]);
        $shop->operators()->create([
            'user_id' => $user->id,
            'is_administrator' => $this->shop_admin,
        ]);
        return $shop;
    }

    public function update(int $id)
    {
        $shopOperator = ShopOperator::where('id', $id)->first();
        User::updateById($shopOperator->user_id, [
            'name' => $this->name,
            'email' => $this->email,
            'active' => $this->shop_operator_active,
        ]);
        if ($this->shop_admin == 1){
            ShopOperator::updateRight($this->operatorShopId, $this->operatorUserId);
        }else{
            ShopOperator::downRight($this->operatorUserId);
        }
        return $shopOperator->shop_id;
    }

    public function createUserCompany(FinanceCompany $company)
    {
        $user = User::store([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'type_id' => UsersType::FINANCIAL_COMPANY(),
        ]);
        $company->operators()->create([
            'user_id' => $user->id,
        ]);
        return $company;
    }



    public function updateUserCompany(ShopOperator $operator)
    {
        User::updateById($operator->user_id, [
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $administrator = ShopOperator::where([
            ['is_administrator', 1],
            ['entity_id',$operator->entity_id],
            ['entity_type',$operator->entity_type],
            ['user_id', 'not like' , $operator->user_id]
        ])->get();

        if(!$administrator->count())
        {
            $operator->is_administrator = ($this->is_administrator != NULL) ? 1 : 0;
        }
        $operator->save();

    }

    public function updateUserShop(ShopOperator $operator)
    {

        User::updateById($operator->user_id, [
            'name' => $this->name,
            'email' => $this->email,
            'active' => $this->shop_operator_active,
        ]);

        $administrator = ShopOperator::where([
            ['is_administrator', 1],
            ['entity_id',$operator->entity_id],
            ['entity_type',$operator->entity_type],
            ['user_id', 'not like' , $operator->user_id]
        ])->get();

        if(!$administrator->count())
        {
            $operator->is_administrator = ($this->shop_admin != NULL) ? 1 : 0;
        }
        $operator->save();
    }

}
