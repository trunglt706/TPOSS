<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\Posts;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->index();
            $table->string('slug')->unique()->index()->nullable();
            $table->integer('group_id')->nullable()->index();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->json('tag')->nullable();
            $table->integer('status')->nullable()->default(Posts::STATUS_SUSPEND);
            $table->integer('order')->nullable();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('public_date')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
