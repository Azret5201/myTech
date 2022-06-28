<?php

namespace Database\Seeders;

use App\Models\DefaultProperty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DefaultProperty::create([
            'name' => 'Цена',
            'is_price' => true
        ]);
    }
}
