<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FinanceCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
        'site',
        'instagram',
    ];

    public function operators()
    {
        return $this->morphMany(ShopOperator::class,'entity');
    }

    public static function updateById(int $id, array $data): void
    {
        self::find($id)->update($data);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'fin_company_id' ,'id');
    }

    public function credit_products()
    {
        return $this->hasMany(CreditProduct::class, 'fin_company_id' ,'id');
    }

    public function creditProductOrders(): hasMany
    {
        return $this->hasMany(CreditProductOrder::class, 'fin_company_id','id');
    }
}
