<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["model", "name", "stock", "brand_id", "category_id", "sub_category_id", "sub_description", "description", "price", "discount", "offer", "status", "types", "policy", "slug"];
    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
    public function colors()
    {
        return $this->hasMany(Color::class);
    }
    public function dimensions()
    {
        return $this->hasOne(Dimension::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
