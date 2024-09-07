<div class="container mx-auto my-5">
<form wire:submit="save">
    @if ($assets)
        <div class="grid grid-cols-6 gap-4 mb-4">
            @foreach($assets as $asset)
                @if($asset->isPreviewable()):
                    <img src="{{ $asset->temporaryUrl() }}">
                @else
                    <img src="https://placehold.co/400?text={{ urlencode($asset->getMimeType()) }}">
                @endif
            @endforeach
        </div>
    @endif
    <div class="dark:bg-gray-800 flex justify-center p-4 place-items-center">
        <x-input type="file" wire:model="assets" multiple></x-input>
        <x-label for="is_private" class="p-2">Private</x-label>
        <x-input type="checkbox" class="p-2" wire:model="is_private" name="is_private"></x-input>

        @error('assets.*') <span class="error">{{ $message }}</span> @enderror

    <button class="border border-gray-100 p-2 ml-3 dark:text-gray-200" type="submit">Upload</button>
    </div>
</form>
</div>
