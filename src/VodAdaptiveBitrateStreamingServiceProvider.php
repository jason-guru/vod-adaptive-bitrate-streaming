<?php

namespace JasonGuru\VodAdaptiveBitrateStreaming;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JasonGuru\VodAdaptiveBitrateStreaming\Services\AwsTranscoder;
use JasonGuru\VodAdaptiveBitrateStreaming\Services\LocalTranscoder;

class VodAdaptiveBitrateStreamingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/vod-abr.php', 'vod-abr');
    }

    public function boot()
    {
        Route::group(['as' => 'api.', 'prefix' => 'api'], function() {
            Route::group($this->routeConfiguration(), function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
            });
        });
        
        app()->bind('Transcoder', function() {
            if(config('vod-abr.transcoder') == 'aws') {
                return new AwsTranscoder();
            } elseif(config('vod-abr.transcoder') == 'local') {
                return new LocalTranscoder();
            }
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('vod-abr.prefix'),
            'middleware' => config('vod-abr.middleware'),
            'as' => config('vod-abr.as')
        ];
    }
}