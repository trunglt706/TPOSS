<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\AdminStoreService;
use Modules\Admins\Entities\Service;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_store_services', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('store_id')->index();
            $table->integer('service_id')->nullable();
            $table->integer('max_users')->nullable()->default(0);
            $table->integer('max_times')->nullable()->default(0);
            $table->integer('max_orders')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(AdminStoreService::STATUS_ACTIVE);
            $table->integer('created_by')->nullable()->index();
            $table->json('support_device')->nullable()->default(json_encode([
                Service::SUPPORT_WEB,
                Service::SUPPORT_WINDOW,
                Service::SUPPORT_MAC,
                Service::SUPPORT_ANDROID,
                Service::SUPPORT_IOS,
            ]));
            $table->integer('total_amount')->nullable()->default(0);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('admin_store_services');
    }
};
