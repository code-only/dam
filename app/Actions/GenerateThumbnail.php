<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class GenerateThumbnail
{
    use AsAction;

    public function handle(Asset $asset, string $version = "v1", $style = "default")
    {
        // ...
    }

    private function generateThumbnail(string $file, string $filetype, $style): string {
        return $file;
    }
}
