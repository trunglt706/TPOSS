<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\Admins;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->nullable();
            $table->string('name');
            $table->integer('group_id')->nullable()->index();
            $table->string('email', 50)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->string('identity_card')->nullable();
            $table->string('tax_code')->nullable();
            $table->date('birthday')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('gender')->nullable()->default(Admins::GENDER_OTHER);
            $table->integer('status')->nullable()->default(Admins::STATUS_UN_ACTIVE);
            $table->boolean('root')->nullable()->default(Admins::NOT_ROOT);
            $table->dateTime('last_login')->nullable();
            $table->boolean('enable_two_factory')->nullable()->default(Admins::DISABLE_TWO_FACTORY);
            $table->boolean('supper')->nullable()->default(Admins::NOT_SUPPER);
            $table->string('password')->nullable();
            $table->dateTime('last_activity')->nullable();
            $table->integer('created_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
