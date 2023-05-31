<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Stores\Entities\Stores;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('business_type_id')->index();
            $table->integer('province_id')->nullable()->index();
            $table->integer('district_id')->nullable()->index();
            $table->integer('ward_id')->nullable()->index();
            $table->integer('area_id')->nullable()->index();
            $table->integer('admin_area_id')->nullable()->index();
            $table->integer('service_id')->nullable()->index();
            $table->integer('assigned_id')->nullable()->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('website')->nullable();
            $table->string('currency')->nullable()->default(Stores::CURRENCY_VN);
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->integer('status')->nullable()->default(Stores::STATUS_UN_ACTIVE);
            $table->dateTime('created_by')->nullable();
            $table->dateTime('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
