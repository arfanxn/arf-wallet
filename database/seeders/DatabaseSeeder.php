<?php

namespace Database\Seeders;

use App\Models\Wallet;
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
        \App\Models\User::factory(1)->create([
            "name" => "Muhammad Arfan",
            "phone_number" => "089506089254",
            "email" => "arf@gmail.com",
            "password" => bcrypt("111222"),
        ])->each(function (\App\Models\User $user) {
            \App\Models\Transaction::factory(rand(50, 100))->create([
                "from_wallet_id" => $user->id,
                "to_wallet_id" => rand(1, 300),
            ]);
        });

        \App\Models\User::factory(300)->create()->each(function (\App\Models\User $user) {

            $toWalletID = rand(1, 300);
            if ($toWalletID == $user->id) {
                $toWalletID += 1;
            }
            \App\Models\Transaction::factory(rand(1, 100))->create([
                "from_wallet_id" =>  $user->id,
                "to_wallet_id" => $toWalletID,
            ]);
        });

        Wallet::where("user_id", "<=", 5)->update(["balance" => "18446744073709551615"]);
    }
}
