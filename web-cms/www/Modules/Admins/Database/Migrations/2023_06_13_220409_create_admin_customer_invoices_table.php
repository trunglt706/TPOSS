<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\AdminCustomerInvoice;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_customer_invoices', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('customer_id')->index();
            $table->string('type')->nullable()->default(AdminCustomerInvoice::TYPE_PERSONAL);
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('id_card')->nullable()->comment('CMND - CCCD');
            $table->json('other')->nullable()->comment('other data');
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
        Schema::dropIfExists('admin_customer_invoices');
    }
};
