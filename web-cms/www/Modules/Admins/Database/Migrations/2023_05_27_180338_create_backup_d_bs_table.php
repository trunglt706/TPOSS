<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\BackupDB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backup_dbs', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->string('description')->nullable();
            $table->bigInteger('size')->nullable();
            $table->string('link')->nullable();
            $table->string('type');
            $table->integer('created_by')->index();
            $table->boolean('status')->default(BackupDB::STATUS_SUCCESS);
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
        Schema::dropIfExists('backup_dbs');
    }
};
