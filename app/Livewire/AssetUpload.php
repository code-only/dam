<?php

namespace App\Livewire;

use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AssetUpload extends Component
{
    use WithFileUploads;

    #[Validate(['assets.*' => 'max:2048'])] // 2MB Max
    public $assets = [];

    public $is_private = false;

    public function render()
    {
        return view('livewire.asset-upload');
    }

    public function save()
    {
        foreach ($this->assets as $file) {
            $path = $file->store(path: 'assets');
            $asset = new Asset([
                'filename' => $file->getClientOriginalName(),
                'filepath' => $path,
                'is_private' => $this->is_private,
                'user_id' => Auth::user()->id,
                'asset_type' => $file->getMimeType()
            ]);
            $asset->save();
        }
        $this->reset('assets');
        return redirect()->to('/assets');
    }
}
