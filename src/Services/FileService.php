<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileService
{
    public function upload(UploadedFile $file, String $collection, $fileName)
    {
        $contents = \Storage::disk('s3')->putFileAs($collection, $file, $fileName);
        return $contents;
    }
}