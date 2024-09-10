<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->asset_id,
            'filename' => $this->filename,
            'url' => $this->filepath,
            'thumbnail' => $this->thumbnail,
            'uploaded_by' => $this->user->name,
            'uploaded_at' => $this->created_at,
            'file_size' => $this->file_size,
            'file_type' => $this->file_type,
            'asset_type' => $this->asset_type,
            'is_private' => (bool) $this->is_private,
            'current_version' => $this->version,
            'status' => $this->status ? "Published" : "Unpublished"
        ];
    }
}
