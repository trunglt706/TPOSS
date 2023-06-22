<?php

namespace Modules\Admins\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $filename = "backup-" . time() . ".sql";
        // Create backup folder and set permission if not exist.
        $storageAt = storage_path() . "/app/backup/";
        if (!File::exists($storageAt)) {
            File::makeDirectory($storageAt, 0755, true, true);
        }
        $command = "" . env('DB_DUMP_PATH', 'mysqldump') . " --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . $storageAt . $filename;
        $returnVar = NULL;
        $output = NULL;
        exec($command, $output, $returnVar);
        // Upload backup file to AWS S3 Bucket 
        $backupFilePath = $storageAt . $filename;
        if (File::exists($backupFilePath)) {
            $path = Storage::disk('s3')->put($filename, $backupFilePath);
            $path = Storage::disk('s3')->url($path); // Get the bucket url for uploaded DB backup file.
            echo $path; // Save to Database for backup log or etc. And, delete the local file from storage.
        }
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
