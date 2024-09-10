<?php

namespace App\Livewire\Assets\View;

use Livewire\Component;

class GridItem extends Component
{
    public Asset $asset;

    public function render()
    {
        return view('livewire.assets.view.grid-item');
    }
}
