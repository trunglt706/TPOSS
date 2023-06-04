<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Entities\Area;
use Modules\Admins\Entities\BusinessType;

class AdminsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed role
        $this->call(SeedRoleTableSeeder::class);

        // seed menu
        $this->call(SeedAdminMenuTableSeeder::class);

        // seed area
        $this->call(SeedAreaTableSeeder::class);

        // seed business type
        $this->call(SeedBusinessTypeTableSeeder::class);

        // seed setting
        $this->call(SeedSettingTableSeeder::class);

        // seed email setting
        $this->call(SeedEmailSettingTableSeeder::class);
    }
}
