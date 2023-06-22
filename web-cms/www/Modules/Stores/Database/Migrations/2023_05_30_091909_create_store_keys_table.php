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
        Schema::create('store_keys', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('store_id')->index();
            $table->string('key')->unique();
            $table->string('pin')->nullable();
            $table->string('rgm')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('computer')->nullable();
            $table->boolean('status')->nullable()->default(true);
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
        Schema::dropIfExists('store_keys');
    }
};
