<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Partners\Entities\PartnerNotify;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_notifies', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('partner_id')->index();
            $table->string('content')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->boolean('status')->default(false);
            $table->string('refType')->nullable()->default(PartnerNotify::TYPE_NOTIFY);
            $table->integer('refTo')->nullable();
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
        Schema::dropIfExists('partner_notifies');
    }
};
