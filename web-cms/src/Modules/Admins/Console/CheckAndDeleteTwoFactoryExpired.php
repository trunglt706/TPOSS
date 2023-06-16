<?php

namespace Modules\Admins\Console;

use Illuminate\Console\Command;
use Modules\Admins\Entities\Admins;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckAndDeleteTwoFactoryExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'check-and-delete-two-factory-expired';

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
        Admins::withoutTimestamps()->twoFactory()->twoFactoryExpired()->update([
            'enable_two_factory_code' => NULL,
            'enable_two_factory_expire' => NULL,
        ]);
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
