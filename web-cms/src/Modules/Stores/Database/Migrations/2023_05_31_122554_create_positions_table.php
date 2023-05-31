<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Stores\Entities\Positions;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('customer_id')->index()->nullable();
            $table->string('name');
            $table->integer('order')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->nullable()->default(Positions::STATUS_ACTIVE);
            $table->integer('basic_salary')->nullable()->default(0);
            $table->integer('created_by')->nullable()->index();
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
        Schema::dropIfExists('positions');
    }
};
