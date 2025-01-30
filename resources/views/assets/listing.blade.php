@php use App\Livewire\Assets\View\ListItem; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assets') }}
        </h2>
    </x-slot>

    <livewire:asset-upload></livewire:asset-upload>
    <div class="container mx-auto grid grid-cols-4 gap-4 dark:text-white">
        @foreach($assets as $asset)
            <div class="asset border p-2 border-gray-500 {{ $asset->is_private ? "bg-gray-600" : "" }}">
                <a href="/assets/{{ $asset->asset_id }}">
                    <img src="{{ $asset->thumbnail["medium"] ?? "" }}">
                    <div class="">{{ $asset->filename }}</div>
                    <div class="dark:text-gray-500">{{ $asset->asset_id }}</div>
                    <div class="dark:text-gray-300">{{ $asset->user->name }}</div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>
