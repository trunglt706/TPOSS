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
        Schema::create('admin_token_devices', function (Blueprint $table) {
            $table->id()->index();
            $table->string('token')->index();
            $table->string('device_name')->nullable();
            $table->string('device_id')->nullable();
            $table->enum('os', ['android', 'ios'])->nullable();
            $table->ipAddress('ip')->nullable()->index();
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_token_devices');
    }
};
