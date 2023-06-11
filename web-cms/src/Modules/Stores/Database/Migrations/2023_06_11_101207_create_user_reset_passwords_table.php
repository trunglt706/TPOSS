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
        Schema::create('user_reset_passwords', function (Blueprint $table) {
            $table->id()->index();
            $table->string('email');
            $table->string('store_code');
            $table->string('token')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('device')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reset_passwords');
    }
};
