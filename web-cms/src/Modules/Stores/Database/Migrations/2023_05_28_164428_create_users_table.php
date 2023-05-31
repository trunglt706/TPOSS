<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Stores\Entities\Users;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->index();
            $table->string('code')->unique();
            $table->integer('client_id')->nullable()->index();
            $table->integer('position_id')->nullable()->index();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('identity_card')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->boolean('root')->nullable()->default(Users::NOT_ROOT);
            $table->boolean('supper')->nullable()->default(Users::NOT_SUPPER);
            $table->dateTime('last_login')->nullable();
            $table->boolean('enable_two_factory')->nullable()->default(false);
            $table->string('password')->nullable();
            $table->dateTime('last_activity')->nullable();
            $table->dateTime('expired_date')->nullable();
            $table->integer('type_work')->nullable()->default(Users::WORK_TYPE_FULL);
            $table->integer('deleted_by')->nullable();
            $table->integer('created_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
