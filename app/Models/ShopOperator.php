<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;

class ShopOperator extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = ['user_id', 'shop_id', 'is_administrator'];

    public static function getAllShopOperator($shopId)
    {
        return self::where('shop_id', $shopId);
    }

    public static function store($data)
    {
        if($data['is_administrator'] == 1){
            self::create($data);
            self::updateRight($data['shop_id'], $data['user_id']);
        }else{
            self::create($data);
        }
    }

    public static function updateRight($shop_id,$id)
    {
        self::where('shop_id', $shop_id)->update([
            'is_administrator' => 0,
        ]);
        self::where('user_id', $id)->update([
            'is_administrator' => 1
        ]);
    }

    public static function downRight($id)
    {
        self::where('user_id', $id)->update([
            'is_administrator' => 0
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->morphedByMany(Shop::class, 'entity_type');
    }

    public function storeShop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, 'entity_id');
    }

    public function operators()
    {
        return $this->morphTo();
    }

    public function company()
    {
        return $this->hasOne(FinanceCompany::class,'id','entity_id');
    }
}


