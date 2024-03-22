<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ZipArchive;

class BackupAttachments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:attachments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup attachments from last month';

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
        $now            = Carbon::now();
        $last_month     = Carbon::now()->subMonths(1)->startOfMonth();
        $diff_from_now  = $last_month->diffInDays($now);

        $zip_name       = 'sisda_attachments_'. date('Y_m_d') .'.zip';
        $backup_dir     = storage_path('app/backup/attachment');
        $storages       = File::allFiles(storage_path('app/public'));
        $zip            = new ZipArchive();

        if ($zip->open($backup_dir . '/' . $zip_name, ZipArchive::CREATE) === TRUE) {
            $this->info("Create zip archives from attachment files since ". $last_month->copy()->format('d F Y'));
            $bar = $this->output->createProgressBar(count($storages));
            $bar->start();

            foreach ($storages as $storage) {
                $file_time = Carbon::createFromTimestamp($storage->getMTime());
                $file_name = $storage->getFilename();
                $in_date_range = $diff_from_now >= $file_time->diffInDays($now);
                if ($in_date_range) {
                    $zip->addFile(public_path('storage/'. $file_name), $file_name);
                }

                $bar->advance();
            }

            $zip->close();
            $bar->finish();
        }

        $this->info("\n Backup attachments finished!. Check file: ". $backup_dir . '/'. $zip_name);
    }
}
