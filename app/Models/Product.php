<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'short_description',
        'description',
        'filament',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}