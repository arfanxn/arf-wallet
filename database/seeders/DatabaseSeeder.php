<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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

        User::create([
            "name" => "muhammad arfan",
            "phone_number" => "089506089254",
            "email" => "arfan@gm.com",
            "password" => "11112222",
        ]);
    }
}
