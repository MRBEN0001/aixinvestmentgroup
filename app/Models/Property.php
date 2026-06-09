<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        $image = ltrim($this->image);

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        if (str_starts_with($image, '/storage/')) {
            return $image;
        }

        if (str_starts_with($image, 'storage/')) {
            return '/' . $image;
        }

        if (str_starts_with($image, 'public/')) {
            return '/storage/' . substr($image, 7);
        }

        return '/storage/' . ltrim($image, '/');
    }
}
