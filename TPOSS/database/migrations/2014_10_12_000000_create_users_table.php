<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name');
            $table->integer('position_id');
            $table->integer('store_id');
            $table->string('email', 50)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->nullable()->default(User::STATUS_UN_ACTIVE);
            $table->boolean('root')->nullable()->default(User::NOT_ROOT);
            $table->string('avatar')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->boolean('enable_two_factory')->nullable()->default(User::DISABLE_TWO_FACTORY);
            $table->boolean('supper')->nullable()->default(User::NOT_SUPPER);
            $table->string('password');
            $table->date('birthday')->nullable();
            $table->integer('gender')->nullable()->default(User::GENDER_OTHER);
            $table->dateTime('last_activity')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();

            $table->index(['id', 'position_id', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
