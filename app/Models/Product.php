<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'short_description',
        'description',
        'filament',
        'colour',
        'pieces',
        'print_time',
        'supports',
        'infill',
        'layer_height',
        'file_format',
        'license',
        'main_image',
        'rating_count',
        'rating_avg',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = static::uniqueSlug($product->name);
            }
        });
    }

    private static function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i    = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }

    /**
     * Resolve the image URL for both legacy seeder paths (products/st1.webp)
     * and new admin-uploaded files (stored in storage/app/public/products/...).
     */
    public function getMainImageUrlAttribute(): string
    {
        if (!$this->main_image) {
            return asset('images/placeholder.webp');
        }
        // Uploaded via admin panel → public/storage/products/...
        if (str_starts_with($this->main_image, 'products/')) {
            $storagePath = storage_path('app/public/' . $this->main_image);
            if (file_exists($storagePath)) {
                return asset('storage/' . $this->main_image);
            }
        }
        // Legacy seeder path e.g. "products/st1.webp" or just "st1.webp"
        $basename = basename($this->main_image);
        return asset('images/' . $basename);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}