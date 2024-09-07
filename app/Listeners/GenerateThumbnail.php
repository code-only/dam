<?php

namespace App\Listeners;

use App\Enums\AssetType;
use App\Events\AssetUploaded;
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
        if($asset->asset_type === AssetType::IMAGE) {
            //@TODO: generate thumbnail
            $image = $this->imageManager->read(Storage::disk()->path($asset->filepath));
            $image->contain(400, 400);
            $thumbnail = "thumbnails/400/" . Str::kebab($asset->filename) . ".webp";
            if(Storage::disk("public")->put($thumbnail, $image->removeAnimation()->toWebp())) {
                $asset->thumbnail = $thumbnail;
            }
        }
        if($asset->asset_type === AssetType::DOCUMENT) {
            if(in_array($asset->file_type, ["pdf"])) {
                $image = $this->imageManager->read(Storage::disk()->path($asset->filepath));
                $image->blendTransparency("ffffff");
                $image->contain(400, 400);
                $thumbnail = "thumbnails/400/" . Str::kebab($asset->filename) . ".webp";
                if(Storage::disk("public")->put($thumbnail, $image->removeAnimation()->toWebp())) {
                    $asset->thumbnail = $thumbnail;
                }
            }
        }
        else {
            $asset->thumbnail = "https://placehold.co/400?text=" . $asset->asset_type->value;
        }
        $asset->save();
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
