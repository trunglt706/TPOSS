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
        Schema::create('partner_licenses', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->nullable()->unique()->index();
            $table->string('description')->nullable();
            $table->integer('max_customers')->nullable()->default();
            $table->integer('max_leads')->nullable()->default();
            $table->integer('max_stores')->nullable()->default();
            $table->integer('max_timeout_to_shutdown_host')->nullable()->default(24)->comment('ĐV theo giờ');
            $table->boolean('status')->nullable()->default(false);
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
        Schema::dropIfExists('partner_licenses');
    }
};
