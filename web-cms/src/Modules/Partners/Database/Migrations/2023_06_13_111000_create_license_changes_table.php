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
        Schema::create('license_changes', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->nullable();
            $table->integer('license_id')->index();
            $table->date('date')->nullable()->default(date('Y-m-d'));
            $table->integer('max_admins')->nullable()->default(1);
            $table->integer('max_customers')->nullable()->default(1);
            $table->integer('max_leads')->nullable()->default(1);
            $table->integer('max_stores')->nullable()->default(1);
            $table->integer('created_by')->index()->nullable();
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
        Schema::dropIfExists('license_changes');
    }
};
