<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'category_id', 'featured_image', 'short_description', 'content', 'status', 'sort_order', 'created_at'];
    
    protected $dates = ['created_at'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
