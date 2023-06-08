<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_histories', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('partner_id')->index();
            $table->integer('license_id')->index();
            $table->dateTime('last_active')->nullable();
            $table->dateTime('last_inactive')->nullable();
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
        Schema::dropIfExists('partner_histories');
    }
};
