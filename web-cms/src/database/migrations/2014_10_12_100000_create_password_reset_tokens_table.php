<?php

use App\Models\PasswordResetToken;
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
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->id()->index();
            $table->string('email');
            $table->string('token')->nullable();
            $table->string('type', 20)->default(PasswordResetToken::TYPE_ADMIN);
            $table->integer('store_id')->nullable()->index();
            $table->ipAddress('ip')->nullable();
            $table->string('device')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
