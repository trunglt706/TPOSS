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
            $table->id()->index();
            $table->integer('admin_id')->index();
            $table->integer('permission_id')->index();
            $table->integer('role_id')->index();
            $table->json('data_json')->nullable();
            $table->string('description');
            $table->ipAddress('ip')->nullable()->index();
            $table->string('device')->nullable();
            $table->string('link')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();
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
