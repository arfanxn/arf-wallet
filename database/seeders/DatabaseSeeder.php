<?php

namespace Database\Seeders;

use App\Models\Transaction;
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

        \App\Models\User::factory(20)->create();

        for ($i = 0; $i < 1000; $i++) {
            \App\Models\Transaction::factory(10000)->create();
        }
    }
}
