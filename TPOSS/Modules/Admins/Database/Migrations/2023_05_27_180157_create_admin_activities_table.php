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
        Schema::create('admin_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('permission_id');
            $table->integer('role_id');
            $table->json('data_json')->nullable();
            $table->string('description');
            $table->ipAddress('ip')->nullable();
            $table->string('device')->nullable();
            $table->string('link')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();

            $table->index(['id', 'permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_activities');
    }
};
