<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            "name" => "muhammad arfan",
            "phone_number" => "089506089254",
            "email" => "arfan@gm.com",
            "password" => bcrypt("111222"),
        ]);

        \App\Models\User::factory(10)->create();

    }
}
