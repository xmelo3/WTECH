<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'path', 'sort'];

    public function getUrlAttribute(): string {
        if (str_starts_with($this->path, 'products/')) {
            $storagePath = storage_path('app/public/' . $this->path);
            if (file_exists($storagePath)) {
                return asset('storage/' . $this->path);
            }
        }
        return asset('images/' . basename($this->path));
    }
    public function product() { return $this->belongsTo(Product::class); }
}