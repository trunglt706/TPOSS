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
        Schema::create('admin_channel_notifies', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique()->index();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->json('settings')->nullable();
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
        Schema::dropIfExists('admin_channel_notifies');
    }
};
