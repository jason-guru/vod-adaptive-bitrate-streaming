<?php

use Illuminate\Support\Facades\Route;
use JasonGuru\VodAdaptiveBitrateStreaming\Http\Controllers\VideoController;

Route::post('upload', [VideoController::class, 'upload'])->name('upload');