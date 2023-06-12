<?php

namespace Modules\Stores\Database\Seeders\Store;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Store\seedMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
