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
        Schema::create('admin_invoices', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('order_id')->index();
            $table->integer('portal_id')->index();
            $table->double('sub_total')->nullable()->default(0);
            $table->double('before_vat')->nullable()->default(0);
            $table->double('after_vat')->nullable()->default(0);
            $table->string('description')->nullable();
            $table->json('data');
            $table->string('link')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_invoices');
    }
};
