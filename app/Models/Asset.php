<?php

namespace App\Models;

use App\Casts\FileSize;
use App\Enums\AssetType;
use App\Events\AssetUploaded;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * @property mixed $file_type
 * @property AssetType|mixed $asset_type
 * @property string $filename
 * @property string $filepath
 * @property boolean $is_private
 * @property User $user
 */
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
        'thumbnail' => NULL
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'thumbnail' => AsArrayObject::class,
            'asset_type' => AssetType::class,
            'file_size' => FileSize::class
        ];
    }

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
            $model->version =  "v1";
            $model->user_id = Auth::user()->id ?? 1;
        });
    }

    /**
     * @return BelongsTo
     */
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
        $asset->file_type = $file->guessExtension();
        $asset->asset_type = AssetType::detect($file->guessExtension());
        $asset->file_size = $file->getSize();
        $asset->save();
        // @TODO: Run with defer() when available.
        AssetUploaded::dispatch($asset);
        return $asset;
    }
}
