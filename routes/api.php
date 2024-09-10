<?php

use App\Http\Resources\AssetCollection;
use App\Http\Resources\AssetResource;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/assets', function (Request $request) {
    return new AssetCollection(Asset::where(['status' => true])->paginate());
});

Route::get('/assets/mine', function (Request $request) {
    return new AssetCollection(Asset::whereBelongsTo(Auth::user())->paginate());
})->middleware('auth:sanctum');

Route::get('/assets/{uuid}', function (string $uuid) {
    return new AssetResource(Asset::where(['asset_id' => $uuid, 'status' => true])->firstOrFail());
});

Route::post('/assets/upload', function (Request $request) {
    $asset = Asset::create($request->file, $request->is_private ?? 0);
    return new AssetResource($asset);
})->middleware('auth:sanctum');
