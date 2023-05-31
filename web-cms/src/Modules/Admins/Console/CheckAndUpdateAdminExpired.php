<?php

namespace Modules\Admins\Console;

use Illuminate\Console\Command;
use Modules\Admins\Entities\AdminRoleDetail;
use Modules\Admins\Entities\Admins;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckAndUpdateAdminExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'admin:check_and_update_expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Admins::expired()->each(function ($admin) {
            $admin->status = Admins::STATUS_SUSPEND;
            $admin->save();
            // send notify email to admin expired to warning

            // send notify to list admin has permission manager admin
            $list_admin = AdminRoleDetail::whereHas('permission', function ($query) {
                $query->extension('admins');
            })->whereHas('role', function ($query) {
                $query->extension('view');
            })->pluck('admin_id')->distinct('admin_id')->toArray();
            if (!is_null($list_admin)) {
                // send to pusher

                // send to firebase

                // send to email

            }
        });
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
