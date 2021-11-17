<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionUserWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('transaction_user_wallet', function (Blueprint $table) {
        //     $table->foreignId("transaction_id")->constrained("transactions")->onDelete("cascade");
        //     $table->foreignId("from_user_id")->constrained("users", "id");
        //     $table->foreignId("from_wallet_id")->constrained("wallets", "id");
        //     $table->foreignId("to_user_id")->constrained("users", "id");
        //     $table->foreignId("to_wallet_id")->constrained("wallets", "id");
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_user_wallet');
    }
}
