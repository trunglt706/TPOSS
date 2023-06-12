<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Database\Seeders\AdminsDatabaseSeeder;
use Modules\Partners\Database\Seeders\PartnersDatabaseSeeder;
use Modules\Stores\Database\Seeders\StoresDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminsDatabaseSeeder::class);
        $this->call(PartnersDatabaseSeeder::class);
        $this->call(StoresDatabaseSeeder::class);
    }
}
