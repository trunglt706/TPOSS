<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name');
            $table->integer('group_id');
            $table->string('email', 50)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->nullable()->default(Admin::STATUS_UN_ACTIVE);
            $table->boolean('root')->nullable()->default(Admin::NOT_ROOT);
            $table->string('avatar')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->boolean('enable_two_factory')->nullable()->default(Admin::DISABLE_TWO_FACTORY);
            $table->boolean('supper')->nullable()->default(Admin::NOT_SUPPER);
            $table->string('password');
            $table->date('birthday')->nullable();
            $table->integer('gender')->nullable()->default(Admin::GENDER_OTHER);
            $table->dateTime('last_activity')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();

            $table->index(['id', 'group_id']);
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
