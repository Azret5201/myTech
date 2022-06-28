<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class StaticPage extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name', 'content', 'slug'];

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
        return self::orderBy('name')->get();
    }

    public static function getById(int $id)
    {
        return self::find($id);
    }

    public static function store(array $data): void
    {
        self::create($data);
    }

    public static function updateById(int $id, array $data): void
    {
        self::find($id)->update($data);
    }


    public static function getByName(string $name)
    {
        return self::where('name', $name)->first();
    }
}
