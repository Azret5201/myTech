<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'display',
    ];

    public function products(): belongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_blocks');
    }

    public static function updateById(int $id, array $data): void
    {
        self::find($id)->update($data);
    }
}
