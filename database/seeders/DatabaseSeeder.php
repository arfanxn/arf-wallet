<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Wallet;
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
            "name" => "Muhammad Arfan",
            "phone_number" => "089506089254",
            "email" => "arfan@gm.com",
            "password" => bcrypt("111222"),
        ]);
        Wallet::where("user_id", "<=", 5)->update(["balance" => "18446744073709551615"]);

        \App\Models\User::factory(200)->create();

        \App\Models\Transaction::factory(1000)->create();

        // for ($i = 0; $i < 10000; $i++) {
        //     try {
        //         \App\Models\User::factory(100)->create();
        //     } catch (\Illuminate\Database\QueryException $e) {
        //         continue;
        //     }
        // }
        // // for ($i = 0; $i < 100; $i++) {
        // //     \App\Models\User::factory(100)->create();
        // // }

        // // for ($i = 0; $i < 1000; $i++) {
        // //     \App\Models\Transaction::factory(10000)->create();
        // // }
    }
}
