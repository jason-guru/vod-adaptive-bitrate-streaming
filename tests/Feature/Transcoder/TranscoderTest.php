<?php
namespace JasonGuru\VodAdaptiveBitrateStreaming\Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use JasonGuru\VodAdaptiveBitrateStreaming\Tests\TestCase;

class TranscoderTest extends TestCase
{
    /** @test */
    public function it_can_upload_video()
    {
        Storage::fake('s3');
        $response = $this->post(route('api.video.upload'), [
            'file' => UploadedFile::fake()->create('video.mp4', '10000', 'mp4'),
        ]);
        $response->assertOk();
    }
}