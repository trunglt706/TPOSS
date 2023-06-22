<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;

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

        // seed admin
        $this->call(SeedAdminTableSeeder::class);

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
