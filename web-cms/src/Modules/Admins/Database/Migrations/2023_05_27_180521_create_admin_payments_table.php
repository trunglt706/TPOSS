<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('admin_payments', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('order_id')->index();
            $table->integer('method_id')->index();
            $table->integer('portal_id')->nullable()->index();
            $table->integer('total')->nullable()->default(0);
            $table->string('description')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->string('attachment')->nullable();
            $table->string('type')->nullable()->default(1);
            $table->integer('created_by')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_payments');
    }
};
