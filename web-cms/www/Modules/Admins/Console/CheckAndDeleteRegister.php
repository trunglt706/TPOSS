<?php

namespace Modules\Admins\Console;

use Illuminate\Console\Command;
use Modules\Admins\Entities\RegisterUsing;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckAndDeleteRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'register_usings:check_and_delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and delete info register > 1 hour';

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
        RegisterUsing::expireTime()->delete();
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
