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
            $table->integer('permission_id')->nullable()->index();
            $table->boolean('type')->nullable()->default(AdminMenus::TYPE_MAIN);
            $table->string('route')->nullable();
            $table->boolean('status')->nullable()->default(AdminMenus::STATUS_ACTIVE);
            $table->string('target')->nullable()->default('self');
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
        Schema::dropIfExists('admin_menuses');
    }
};
