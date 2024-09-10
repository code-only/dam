<?php

namespace App\Listeners;

use App\Enums\AssetType;
use App\Events\AssetUploaded;
use App\Models\Asset;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Event\Dispatcher;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class GenerateThumbnail
{
    protected $imageManager;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    /**
     * Handle the event.
     */
    public function handle(AssetUploaded $event): void
    {
        $asset = $event->asset;
        // @TODO: Define styles.
        if ($asset->asset_type === AssetType::IMAGE) {
            $thumbnailImage = $this->getThumbnail($asset, width: 300, height: 300);
            $thumbnail = $this->saveThumbnail($thumbnailImage, Str::kebab($asset->filename), "medium");
        } elseif ($asset->asset_type === AssetType::DOCUMENT && in_array($asset->file_type, ["pdf"])) {
                $thumbnailImage = $this->getThumbnail($asset);
                $thumbnailImage->blendTransparency("ffffff");
                $thumbnail = $this->saveThumbnail($thumbnailImage, Str::kebab($asset->filename), "medium");
        }
        else {
            $thumbnail["medium"] = "https://placehold.co/400?text=" . $asset->asset_type->value;
        }
        $asset->thumbnail = array_merge($asset->thumbnail ?? [], $thumbnail);
        $asset->save();
    }

    private function getThumbnail(Asset $asset, string $style = "medium", int $width = 400, int $height = 400) {
        $image = $this->imageManager->read(Storage::disk()->path($asset->filepath));
        $image->contain($width, $height);
        return $image;
    }

    /**
     * @param $image
     * @param $filename
     * @param string $style
     * @param int $width
     * @param int $height
     * @return array|void
     */
    private function saveThumbnail($image, $filename, string $style, int $width = 400, int $height = 400) {
        $thumbnail[$style] = "thumbnails/{$style}/" . $filename . ".webp";
        if(Storage::disk("public")->put($thumbnail[$style], $image->removeAnimation()->toWebp())) {
            return $thumbnail;
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            AssetUploaded::class => 'handle',
        ];
    }
}
