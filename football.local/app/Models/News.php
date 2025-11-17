<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'publish_date',
        'is_published',
        'gallery',
        'category',
        'author', 
        'tags',
        'meta_description'
    ];

    protected $casts = [
        'publish_date' => 'date',
        'is_published' => 'boolean',
        'gallery' => 'array',
        'tags' => 'array'
    ];

   
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    
     public function scopeCategory($query, $category)
     {
       return $query->where('category', $category);
     }

    
    public function getGalleryCountAttribute()
    {
      return $this->gallery ? count($this->gallery) : 0;
    }

   
     public function getTagsCountAttribute()
     {
        return $this->tags ? count($this->tags) : 0;
    }
}