<?php

namespace JasonGuru\VodAdaptiveBitrateStreaming\Tests;

use JasonGuru\VodAdaptiveBitrateStreaming\VodAdaptiveBitrateStreamingServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            VodAdaptiveBitrateStreamingServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}