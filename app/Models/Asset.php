<?php

namespace App\Models;

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
        'thumbnail',
        'asset_type',
        'is_private',
        'user_id',
        'status'
    ];

    protected $attributes = [
        'is_private' => false,
    ];

    // Registering model events
    protected static function boot()
    {
        parent::boot();
        // Event fired before a model is created
        static::creating(function ($model) {
            $model->asset_id =  (string) Str::orderedUuid();
            //$model->user_id = Auth::user();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
