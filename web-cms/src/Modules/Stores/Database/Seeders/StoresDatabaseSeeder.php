<?php

namespace Modules\Stores\Database\Seeders;

use Illuminate\Database\Seeder;

class StoresDatabaseSeeder extends Seeder
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
        $this->call(SeedMenuTableSeeder::class);

        // seed setting
        $this->call(SeedSettingTableSeeder::class);
    }
}
