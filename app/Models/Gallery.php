<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    // protected $table = 'galeri';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image_path',
        'user_id', // <-- PASTIKAN 'user_id' ADA DI SINI
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}