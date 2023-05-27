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
        Schema::create('admin_role_details', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->integer('permission_id');
            $table->integer('role_id')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();

            $table->index(['id', 'admin_id', 'permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_role_details');
    }
};
