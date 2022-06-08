<?php
namespace JasonGuru\VodAdaptiveBitrateStreaming\Http\Controllers;

use FFMpeg\FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JasonGuru\VodAdaptiveBitrateStreaming\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function upload(Request $request)
    {
        resolve('Transcoder')->upload($request->file, 'package-test', 'video.mp4');
        return response()->json([
            'success' => true
        ]);
    }

    public function play($playlist)
    {
        return FFMpeg::dynamicHLSPlaylist()
            ->fromDisk('public')
            ->open("videos/{$playlist}")
            ->setKeyUrlResolver(function ($key) {
                return route('video.key', ['key' => $key]);
            })
            ->setPlaylistUrlResolver(function ($playlist) {
                return route('video.playlist', ['playlist' => $playlist]);
            })
            ->setMediaUrlResolver(function ($media) {
                return Storage::disk('public')->url("videos/{$media}");
        });
    }

    public function key($key) 
    {
        return Storage::disk('secrets')->download($key);
    }
}