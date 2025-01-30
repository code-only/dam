<?php

namespace App\Livewire;

use App\Models\Asset;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AssetUpload extends Component
{
    use WithFileUploads;

    #[Validate(['assets.*' => 'max:8096'])] // 2MB Max
    public $assets = [];

    public $is_private = false;

    public function render()
    {
        return view('livewire.asset-upload');
    }

    public function save()
    {
        foreach ($this->assets as $file) {
            Asset::create($file, $this->is_private);
        }
        $this->reset('assets');
        return redirect()->to('/assets');
    }
}
