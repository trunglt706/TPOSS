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
            $table->id();
            $table->integer('group_id');
            $table->integer('permission_id');
            $table->integer('role_id')->nullable();
            $table->boolean('status')->nullable()->default(AdminGroupRoleSample::STATUS_SUSPEND);
            $table->timestamps();

            $table->index(['id', 'group_id', 'permission_id', 'role_id']);
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
