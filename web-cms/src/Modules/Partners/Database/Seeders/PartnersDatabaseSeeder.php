<?php

namespace Modules\Partners\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PartnersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed role
        // $this->call(SeedRoleTableSeeder::class);

        // seed menu
        $this->call(SeedMenuTableSeeder::class);

        // // seed setting
        // $this->call(SeedSettingTableSeeder::class);
    }
}
