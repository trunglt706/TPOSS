<?php

namespace Modules\Admins\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckAndAutoBackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'check_update:auto_backup_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check to auto run backup database';

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
