<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\File;
use ZipArchive;

class BackupAttchmentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data  = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $now            = Carbon::now();
        $last_day       = $this->lastDayByType($this->data['type']);
        $diff_from_now  = $last_day->diffInDays($now);

        $zip_name       = $this->data['file_name'] .'_attachments.zip';
        $backup_dir     = storage_path('app/backup/attachment');
        $storages       = File::allFiles(storage_path('app/public'));
        $zip            = new ZipArchive();

        if ($zip->open($backup_dir . '/' . $zip_name, ZipArchive::CREATE) === TRUE) {
            foreach ($storages as $storage) {
                $file_time = Carbon::createFromTimestamp($storage->getMTime());
                $file_name = $storage->getFilename();
                $in_date_range = $diff_from_now >= $file_time->diffInDays($now);
                if ($in_date_range) {
                    $zip->addFile(public_path('storage/'. $file_name), $file_name);
                }
            }

            $zip->close();
        }

        return true;
    }

    private function lastDayByType($type)
    {
        $now = Carbon::now();
        return $type == 'monthly' ? $now->subMonths(1)->startOfMonth() : $now->modify("last Monday");
    }
}
