<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\AdminLead;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_leads', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('province_id')->nullable()->index();
            $table->integer('district_id')->nullable()->index();
            $table->integer('ward_id')->nullable()->index();
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('gender')->nullable()->default(AdminLead::GENDER_OTHER);
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->nullable()->default(AdminLead::STATUS_ACTIVE);
            $table->integer('created_by')->nullable()->index();
            $table->integer('assigned_id')->nullable()->index();
            $table->string('source')->nullable()->default('');
            $table->dateTime('converted_at')->nullable();
            $table->integer('customer_id')->nullable()->index();
            $table->string('identity_card')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
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
        Schema::dropIfExists('admin_leads');
    }
};
