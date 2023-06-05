<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\AdminMenus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->boolean('type')->nullable()->default(AdminMenus::TYPE_MAIN);
            $table->string('route')->nullable();
            $table->boolean('status')->nullable()->default(AdminMenus::STATUS_ACTIVE);
            $table->string('target')->nullable()->default(AdminMenus::TARGET_SELF);
            $table->integer('parent_id')->nullable()->default(0)->index();
            $table->string('icon')->nullable();
            $table->integer('order')->nullable()->default(0);
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
        Schema::dropIfExists('admin_menus');
    }
};
