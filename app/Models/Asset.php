<?php

namespace App\Models;

use App\Enums\AssetType;
use App\Events\AssetUploaded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Asset extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'filename',
        'filepath',
        'is_private',
    ];

    protected $attributes = [
        'is_private' => false,
        'status' => true,
        'thumbnail' => null,
        'asset_type' => AssetType::class
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['user_id'];

    protected $perPage = 20;

    // Registering model events
    protected static function boot()
    {
        parent::boot();
        // Event fired before a model is created
        static::creating(function ($model) {
            $model->asset_id =  (string) Str::orderedUuid();
            $model->user_id = Auth::user()->id ?? 1;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function create($file, $is_private = false): Asset {
        $path = $is_private ? $file->store(path: 'assets') : $file->storePublicly('assets');
        $asset = new Asset([
            'filename' => $file->getClientOriginalName(),
            'filepath' => $path,
            'is_private' => $is_private
        ]);
        $asset->user_id = Auth::user()->id ?? 1;
        $asset->file_type = $file->guessExtension();
        $asset->asset_type = AssetType::detect($file->guessExtension());
        $asset->save();
        AssetUploaded::dispatch($asset);
        return $asset;
    }
}
