<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
        'images' => 'array',
        'features' => 'array',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->property_images[0] ?? null;
    }

    public function getPropertyImagesAttribute(): array
    {
        $images = collect($this->images ?? [])
            ->filter()
            ->map(fn (string $image): ?string => $this->imageUrlFromPath($image))
            ->filter()
            ->values()
            ->all();

        if (empty($images) && $this->image) {
            $legacyImage = $this->imageUrlFromPath($this->image);

            if ($legacyImage) {
                $images[] = $legacyImage;
            }
        }

        return $images;
    }

    public function getFeatureListAttribute(): array
    {
        return collect($this->features ?? [])
            ->filter()
            ->values()
            ->all();
    }

    private function imageUrlFromPath(string $path): ?string
    {
        $image = ltrim($path);

        if ($image === '') {
            return null;
        }

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
