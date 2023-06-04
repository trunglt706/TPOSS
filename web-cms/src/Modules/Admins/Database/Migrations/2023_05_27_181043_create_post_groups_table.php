<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\PostGroup;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_groups', function (Blueprint $table) {
            $table->id()->index();
            $table->string('slug')->unique()->index();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->integer('status')->nullable()->default(PostGroup::STATUS_ACTIVE);
            $table->integer('order')->nullable();
            $table->integer('created_by')->nullable()->index();
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
        Schema::dropIfExists('post_groups');
    }
};
