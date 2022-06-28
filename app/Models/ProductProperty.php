<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductProperty extends Model
{
    use HasFactory;

    protected $table = 'product_properties';
    protected $fillable = ['default_property_id', 'product_id', 'value', 'should_user_fill'];

    public static function updateOrCreateById($default_property_id, $product_id, $value, $should_user_fill = false, $property_name_id = 0): void
    {
        self::updateOrCreate(
            [
                'id' => $property_name_id
            ],
            [
                'default_property_id' => $default_property_id,
                'product_id' => $product_id,
                'value' => $value,
                'should_user_fill' => $should_user_fill
            ]);
    }

    public function propName(): BelongsTo
    {
        return $this->belongsTo(DefaultProperty::class, 'default_property_id', 'id');
    }
}
