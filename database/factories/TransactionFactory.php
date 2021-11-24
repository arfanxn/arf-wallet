<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // transfer
        return [
            "tx_hash" => strtoupper(Str::random(10)) . preg_replace("/[^0-9]+/",  "", now()->toDateTimeString()),
            "from_wallet_id" => 1,
            "to_wallet_id" => rand(2, 4),
            "amount" => rand(10000, 999999),
            "charge" => rand(0, 7000),
            "description" => $this->faker->text(100),
            "status" => 1,
        ];

        // received 
        return [
            "tx_hash" => strtoupper(Str::random(10)) . preg_replace("/[^0-9]+/",  "", now()->toDateTimeString()),
            "from_wallet_id" => rand(2, 6),
            "to_wallet_id" => 1,
            "amount" => rand(10000, 999999),
            "charge" => rand(0, 7000),
            "description" => $this->faker->text(100),
            "status" => 1,
        ];
    }
}
