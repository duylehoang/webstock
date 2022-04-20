<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'type', 'description', 'banner', 'parent', 'sort_order'];

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent', 'id');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
