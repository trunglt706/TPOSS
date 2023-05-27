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
        Schema::create('admin_method_payments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(true);
            $table->boolean('has_portal')->nullable()->default(false);
            $table->integer('created_by');
            $table->timestamps();

            $table->index(['id', 'created_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_method_payments');
    }
};
