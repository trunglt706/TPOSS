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
            $table->string('description')->nullable();
            $table->integer('max_customers')->nullable()->default();
            $table->integer('max_leads')->nullable()->default();
            $table->integer('max_stores')->nullable()->default();
            $table->boolean('status')->nullable()->default(true)->comment('status of license');
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
