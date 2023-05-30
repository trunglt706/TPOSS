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
        Schema::create('stores', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->integer('province_id')->nullable()->index();
            $table->integer('district_id')->nullable()->index();
            $table->integer('ward_id')->nullable()->index();
            $table->integer('area_id')->nullable()->index();
            $table->integer('service_id')->nullable()->index();
            $table->integer('assigned_id')->nullable()->index();
            $table->integer('customer_id')->nullable()->index();
            $table->string('mst')->nullable();
            $table->string('website')->nullable();
            $table->string('currency')->nullable()->default('VND');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('stores');
    }
};
