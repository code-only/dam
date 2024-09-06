<?php

namespace Tests\Feature\Livewire;

use App\Livewire\AssetUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AssetUploadTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AssetUpload::class)
            ->assertStatus(200);
    }
}
