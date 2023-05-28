<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Admins\Entities\AdminGroupRoleSample;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('admin_group_role_samples', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('group_id')->index();
            $table->integer('permission_id')->index();
            $table->integer('role_id')->nullable()->index();
            $table->boolean('status')->nullable()->default(AdminGroupRoleSample::STATUS_SUSPEND);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_group_role_samples');
    }
};
