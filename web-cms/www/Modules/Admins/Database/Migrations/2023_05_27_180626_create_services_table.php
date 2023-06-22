<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique()->index();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('max_stores')->nullable()->default(0);
            $table->integer('max_users')->nullable()->default(0);
            $table->integer('max_times')->nullable()->default(0);
            $table->integer('max_orders')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(Service::STATUS_ACTIVE);
            $table->integer('created_by')->nullable()->index();
            $table->json('support_device')->nullable()->default(json_encode([
                Service::SUPPORT_WEB,
                Service::SUPPORT_WINDOW,
                Service::SUPPORT_MAC,
                Service::SUPPORT_ANDROID,
                Service::SUPPORT_IOS,
            ]));
            $table->integer('total_amount')->nullable()->default(0);
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
        Schema::dropIfExists('services');
    }
};
