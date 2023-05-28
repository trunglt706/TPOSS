<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\AdminOrder;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->index();
            $table->integer('service_id')->index();
            $table->date('start_date')->nullable()->default(date('Y-m-d'));
            $table->date('end_date')->nullable();
            $table->integer('discount_type')->nullable()->default(AdminOrder::DISCOUNT_TYPE_PERCENT);
            $table->integer('discount_value')->nullable()->default(0);
            $table->double('discount_total')->nullable()->default(0);
            $table->integer('vat_value')->nullable()->default(0);
            $table->double('vat_total')->nullable()->default(0);
            $table->double('sub_total')->nullable()->default(0);
            $table->double('total')->nullable()->default(0);
            $table->string('description')->nullable();
            $table->string('url_view')->nullable();
            $table->integer('status')->nullable()->default(AdminOrder::STATUS_TMP);
            $table->timestamps();
            $table->integer('created_by')->index();
            $table->softDeletes();
            $table->integer('deleted_by')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_orders');
    }
};
