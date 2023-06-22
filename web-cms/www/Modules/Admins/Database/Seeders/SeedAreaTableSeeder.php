<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\Area;

class SeedAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::truncate();

        Area::create([
            'name' => 'Miền Bắc',
        ]);
        Area::create([
            'name' => 'Miền Trung',
        ]);
        Area::create([
            'name' => 'Miền Nam',
        ]);
    }
}
