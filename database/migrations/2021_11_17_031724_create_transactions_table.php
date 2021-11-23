<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // $table->foreignId("from_user_id")->constrained("users", "id");
            $table->string("tx_hash")->default(
                strtoupper(Str::random(10)) . preg_replace("/[^0-9]+/",  "", now()->toDateTimeString())
            );
            $table->foreignId("from_wallet_id")->constrained("wallets", "id");
            // $table->foreignId("to_user_id")->constrained("users", "id");
            $table->foreignId("to_wallet_id")->nullable()->constrained("wallets", "id");
            $table->unsignedBigInteger("amount");
            $table->unsignedInteger("charge")->default(0);
            $table->string("description", 1000)->nullable();
            $table->boolean("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
