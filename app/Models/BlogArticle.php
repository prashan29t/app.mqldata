<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    use HasFactory;

    // Define the table if it's not the default 'blog_articles'
    protected $table = 'blog_articles';

    // Define any fillable fields if needed
    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'author',
        'nofollow',
        'noindex',
        'is_published',
        'published_at',
        'cover_image', 
    ];
    
    
}