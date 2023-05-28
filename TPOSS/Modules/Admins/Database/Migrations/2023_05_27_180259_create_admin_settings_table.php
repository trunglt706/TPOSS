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
    public function up(): void
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('group_id')->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('value');
            $table->string('data')->nullable();
            $table->integer('order')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_settings');
    }
};
