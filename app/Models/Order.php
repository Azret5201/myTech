<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'shop_id',
        'name',
        'email',
        'phone',
        'credit_products',
        'total',
    ];

    public function productOrders(): hasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function companies(): hasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function creditProductOrders(): HasOne
    {
        return $this->HasOne(CreditProductOrder::class,'order_id','id');
    }

    public function productOrder(): HasOne
    {
        return $this->HasOne(OrderProduct::class,'order_id','id');
    }

    public function user(): HasOne
    {
        return $this->HasOne(User::class, 'id','client_id');
    }

    public function images(): hasMany
    {
        return $this->hasMany(FileUpload::class, 'entity_id', 'id')->where('entity_type','App\Services\File\Interfaces\OrderMediaClass');
    }
}
