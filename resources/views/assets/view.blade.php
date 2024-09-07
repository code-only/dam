<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-between">
            <span>@if ($asset->is_private === 1)
                {{ __('Private ') }}
            @endif
            {{ __('Asset: ') . $asset->filename }}</span>
                <a href="/assets" class=""><< Back </a>
        </h2>
    </x-slot>

    <div class="container mx-auto dark:text-white py-12 grid grid-cols-2">
        <div class="asset p-2 ">
            <img src="/{{ $asset->thumbnail }}" class="border border-gray-500 p-2">
            <div class="dark:text-gray-500">{{ __('Uploaded By: ') . $asset->user->name }}</div>
        </div>
        <div class="assets-info px-4 py-2">
            <div class="dark:text-gray-300">
                <x-input id="asset_filename" name="filename" type="text" value="{{ $asset->filename }}" />
            </div>
            <div class="">{{ $asset->filepath }}</div>
        </div>

    </div>
</x-app-layout>
