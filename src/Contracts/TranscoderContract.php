<?php
namespace JasonGuru\VodAdaptiveBitrateStreaming\Contracts;

use Illuminate\Http\UploadedFile;

interface TranscoderContract
{
    public function upload(UploadedFile $file, String $collection, String $fileName);
    public function transcode();
}