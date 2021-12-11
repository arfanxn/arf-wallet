<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 200; $i++) {
            Transaction::create([
                "from_wallet_id" => rand(11, 20),
                "to_wallet_id" => rand(1, 10),
                "amount" => rand(10000, 9999999999),
                "charge" => rand(1000, 10000),
                "description" => "Receive Money -> Hello im iteration number " . $i,
            ]);
            Transaction::create([
                "from_wallet_id" => rand(0, 10),
                "to_wallet_id" => rand(11, 20),
                "amount" => rand(10000, 9999999999),
                "charge" => rand(1000, 10000),
                "description" => "Send Money -> Hello im iteration number " . $i,
            ]);
        }
    }
}
