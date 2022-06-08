<?php
namespace JasonGuru\VodAdaptiveBitrateStreaming\Services;

use FFMpeg\Format\Video\X264;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LocalTranscoder
{
    public function transcode(String $input, String $output)
    {
        $superLowBitrate = (new X264)->setKiloBitrate(125);
        // $lowBitrate = (new X264)->setKiloBitrate(250);
        $midBitrate = (new X264)->setKiloBitrate(500);
        $highBitrate = (new X264)->setKiloBitrate(1000);

        \FFMpeg::fromDisk('uploads')
            ->open($input)
            ->exportForHLS()
            ->withRotatingEncryptionKey(function( $filename, $contents) {
                Storage::disk('secrets')->put($filename, $contents);
            })
            ->setSegmentLength(10) // optional
            ->setKeyFrameInterval(48) // optional
            ->addFormat($superLowBitrate)
            // ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            ->addFormat($highBitrate)
            ->toDisk('public')
            ->save($output);
    }
}