<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Shop extends Model
{
    use HasFactory, SoftDeletes;
    use HasSlug;

    protected $fillable = ['name', 'description', 'address', 'contacts'];
    protected $casts = [
        'contacts' => Json::class,
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function getAll()
    {
        return self::with('operators')->orderBy('name')->get();
    }

    public static function store(array $data): void
    {
        self::create($data);
    }

    public static function updateById(int $id, array $data): void
    {
        self::find($id)->update($data);
    }

    public function operators()
    {
        return $this->morphMany(ShopOperator::class,'entity');
    }

    public function shop()
    {
        return $this->hasMany(ShopOperator::class, 'entity_id');
    }

    public function users()
    {
        return $this->hasMany(ShopOperator::class, 'entity_id');
    }

}
