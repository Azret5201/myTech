<?php

namespace Database\Seeders;

use App\Models\DefaultProperty;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property = DefaultProperty::create([
            'name' => 'Цена',
            'is_price' => true
        ]);

    }
}
