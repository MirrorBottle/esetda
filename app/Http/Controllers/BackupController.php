<?php

namespace App\Http\Controllers;

use App\Http\Requests\BackupUploadRequest;
use App\Jobs\BackupAttchmentsJob;
use BackupManager\Filesystems\Destination;
use BackupManager\Manager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\Flysystem\FileExistsException;
use League\Flysystem\FileNotFoundException;
use ZipArchive;

class BackupController extends Controller
{
    public function index(Request $request)
    {
        if (!file_exists(storage_path('app/backup/db'))) {
            $backups = [];
        } else {
            $backups = File::allFiles(storage_path('app/backup/db'));

            // Sort files by modified time DESC
            usort($backups, function($a, $b) {
                return -1 * strcmp($a->getMTime(), $b->getMTime());
            });
        }

        return view('backup.index',compact('backups'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file_name' => 'max:30|regex:/^[\w._-]+$/'
        ]);

        try {
            $manager = app()->make(Manager::class);
            $fileName = $request->get('file_name') ?: 'sisda_'. date('Y_m_d');

            // make database backup
            $manager->makeBackup()->run('mysql', [
                new Destination('local', 'backup/db/' . $fileName)
            ], 'gzip');

            // make attachment backup
            $data = ['file_name' => $fileName, 'type' => $request->type];
            BackupAttchmentsJob::dispatch($data)->onQueue('backup');

            return back()->with('success', 'Berhasil membuat berkas backup');
        } catch (FileExistsException $e) {
            return redirect()->route('backup.index');
        }
    }

    public function destroy($fileName)
    {
        if (file_exists(storage_path('app/backup/db/') . $fileName)) {
            $attachmentName = substr($fileName, 0, -3) .'_attachments.zip';
            unlink(storage_path('app/backup/db/') . $fileName);
            // unlink(storage_path('app/backup/attachment/') . $attachmentName);
        }
        return back()->with('success', 'Berhasil menghapus data berkas');
    }

    public function download($fileName)
    {
        return response()->download(storage_path('app/backup/db/') . $fileName);
    }

    public function downloadAttachment($zip_name)
    {
        // Set Header
        $headers = array('Content-Type' => 'application/octet-stream');

        $backup_dir = storage_path('app/backup/attachment');
        $filetopath = $backup_dir.'/'.$zip_name;

        // Create Download Response
        if (file_exists($filetopath)){
            return response()->download($filetopath, $zip_name, $headers);
        }

        abort(404);
    }

    public function restore($fileName)
    {
        try {
            $manager = app()->make(Manager::class);
            $manager->makeRestore()->run('local', 'backup/db/' . $fileName, 'mysql', 'gzip');
        } catch (FileNotFoundException $e) {}

        return back()->with('success', 'Berhasil melakukan restore database');
    }

    public function upload(BackupUploadRequest $request)
    {
        $file = $request->file('backup_file');

        if (file_exists(storage_path('app/backup/db/') . $file->getClientOriginalName()) == false) {
            $file->storeAs('backup/db', $file->getClientOriginalName());
        }

        return back()->with('success', 'Berhasil mengupload berkas backup');
    }
}
