<?php

namespace Modules\Admins\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Admins\Entities\Admins;
use Faker\Generator as Faker;

class GenerateDataAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $admin_group_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin_group_id)
    {
        $this->admin_group_id = $admin_group_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Faker $faker)
    {
        for ($i = 0; $i < 500; $i++) {
            Admins::create([
                'name' => $faker->unique()->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => format_phone($faker->unique()->phoneNumber()),
                'group_id' => $this->admin_group_id,
                'status' => Admins::STATUS_ACTIVE,
                'address' => $faker->address(),
                'tax_code' => $faker->creditCardNumber
            ]);
        }
    }
}
