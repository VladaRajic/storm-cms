<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id',
        'path',
        'is_main'
    ];

    public function scopeMainImage(Builder $query)
    {
        $query->where('is_main', 1);
    }

    public function getImgUrl(): string
    {
        return asset('storage/'.$this->path);
    }
}
