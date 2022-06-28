<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'fin_company_id',
    ];

    public function products(): belongsToMany
    {
        return $this->belongsToMany(CreditProduct::class, 'credit_product_documents');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(FinanceCompany::class,'fin_company_id');
    }
}
