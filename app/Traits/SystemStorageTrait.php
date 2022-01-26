<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait SystemStorageTrait
{
    public $full_url;
    public $real_path;
    public $db_directory;

    public function uploadFile($requestFile, $folder, $disk = 'bucket')
    {

        $fileName = Str::uuid() . time() . '.' . $requestFile->getClientOriginalExtension();
        $path = rtrim($folder, '/') . '/';

        $path = $requestFile->storeAs(
            $path, $fileName, $disk
        );
        $path = preg_replace('#/+#', '/', $path);

        $this->db_directory = $path;
        $this->real_path = Storage::disk($disk)->getDriver()->getAdapter()->getPathPrefix() . $path;
        $this->full_url = Storage::disk($disk)->url($path);
    }

    public function removeFile($dbPath, $disk = 'bucket')
    {
        Storage::disk($disk)->delete($dbPath);
    }

    private function makeDir($path, $disk = 'bucket')
    {
        $storagePath = Storage::disk($disk)->getDriver()->getAdapter()->getPathPrefix();
        if (!File::exists($storagePath . "/" . $path)) {
            $dir = File::makeDirectory($storagePath . "/" . $path, $mode = 0777, true, true);
        }
    }
}
