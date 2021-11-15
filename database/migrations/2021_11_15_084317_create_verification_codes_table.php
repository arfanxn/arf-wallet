<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()
                ->onDelete("cascade")->onUpdate("cascade");
            $table->string("email", 255)->nullable()->constrained("users", "email")
                ->onUpdate("cascade");
            $table->unsignedInteger("code");
            $table->dateTime("expire_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verification_codes');
    }
}
