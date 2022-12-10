<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'description', 
        'image_id', 
        'category_id',
        'quantity',
        'price',
        'flag'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
