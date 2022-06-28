<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory,
    NodeTrait;
    protected $fillable = [
        'name',
        'description',
        'percent',
        'parent_id'
    ];

    public static function store(array $data): void
    {
        self::create($data);
    }

    public static function updateById(int $id, array $data): void
    {
        self::find($id)->update($data);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
