<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\RegisterUsing;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_usings', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('business_type_id')->index();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->integer('service_id')->index();
            $table->integer('lead_id')->nullable()->index();
            $table->dateTime('date_convert')->nullable();
            $table->string('ip')->nullable()->index();
            $table->string('device')->nullable();
            $table->string('verify_code')->nullable();
            $table->string('expired_code')->nullable();
            $table->integer('status')->nullable()->default(RegisterUsing::STATUS_WAIT);
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
        Schema::dropIfExists('register_usings');
    }
};
