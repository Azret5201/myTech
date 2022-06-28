<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

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

    public static function addArrayName($names)
    {
        foreach ($names as $name) {
            if (null === Brand::getByName($name)) {
                Brand::store([
                    'name' => $name,
                ]);
            }
        }
    }

    public static function getByName(string $name)
    {
        return Brand::where('name', $name)->first();
    }
}
