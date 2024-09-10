<div class="asset border p-2 border-gray-500 {{ $asset->is_private ? "bg-gray-600" : "" }}">
    <a href="/assets/{{ $asset->asset_id }}">
        <img src="{{ $asset->thumbnail }}">
        <div class="">{{ $asset->filename }}</div>
        <div class="dark:text-gray-500">{{ $asset->asset_id }}</div>
        <div class="dark:text-gray-300">{{ $asset->user->name }}</div>
    </a>
</div>
