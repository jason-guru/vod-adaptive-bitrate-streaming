<?php

namespace JasonGuru\VodAdaptiveBitrateStreaming\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use JasonGuru\VodAdaptiveBitrateStreaming\Contracts\TranscoderContract;

class AwsTranscoder implements TranscoderContract
{
    public function upload(UploadedFile $file, String $collection, String $fileName)
    {
        $content = Storage::disk('s3')->putFileAs($collection, $file, $fileName);
        return $content;
    }

    public function transcode()
    {
        
    }
}