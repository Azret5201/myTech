<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProductProperties extends Model
{
    use HasFactory;

    protected $fillable = ['default_property_id', 'user_product_id', 'value'];

    public function userProduct()
    {
        return $this->belongsTo(UserProducts::class);
    }
    public function defaultProperty()
    {
        return $this->belongsTo(DefaultProperty::class);
    }
}
