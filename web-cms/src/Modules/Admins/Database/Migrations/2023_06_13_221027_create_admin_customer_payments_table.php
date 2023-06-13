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
        Schema::create('admin_customer_payments', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('customer_id')->index();
            $table->string('type')->nullable()->default();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('account_bank')->nullable();
            $table->string('address_bank')->nullable();
            $table->string('name_bank')->nullable();
            $table->json('other')->nullable()->comment('other data');
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
        Schema::dropIfExists('admin_customer_payments');
    }
};
