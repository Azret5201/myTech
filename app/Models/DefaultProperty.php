<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultProperty extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'default_properties';
    public $timestamps = false;

    public static function checkGetId($name)
    {
        $id = DefaultProperty::getByName($name) ? DefaultProperty::getByName($name)->id : false;
        return $id;
    }
    public static function checkOrCreate($name){
        DefaultProperty::getByName($name) ? DefaultProperty::getByName($name) : DefaultProperty::create(['name' => $name]);
    }

    public static function storeGetId($name){
        $id = DefaultProperty::create(['name' => $name])->id;
        return $id;
    }

    public static function getByName(string $name)
    {
        return DefaultProperty::where('name', $name)->first();
    }

    public function userProductProperties()
    {
        return $this->hasMany(UserProductProperties::class);
    }

}
