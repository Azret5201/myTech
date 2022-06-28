<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CreditProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fin_company_id',
        'min_sum',
        'max_sum',
        'min_loan_term',
        'max_loan_term',
        'annual_interest_rate',
        'issuance_fee',
        'cash_withdrawal_fee',
    ];

    public function documents(): belongsToMany
    {
        return $this->belongsToMany(Document::class, 'credit_product_documents');
    }

    public function company(): HasOne
    {
        return $this->hasOne(FinanceCompany::class,'id','fin_company_id');
    }

}
