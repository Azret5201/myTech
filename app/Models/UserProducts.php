<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProducts extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'quantity'];

    public function userProductProperties()
    {
        return $this->hasMany(UserProductProperties::class, 'user_product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
