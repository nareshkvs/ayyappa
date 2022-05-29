<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogLike extends Model
{
    use HasFactory;

    protected $table = 'blog_likes';

    protected $fillable = [
        'user_id',
        'ip',
        'user_agent',
    ];

    public function scopeForBlog($query, Blog $blog)
    {
        return $query->where('blog_id', $blog->id);
    }

    public function scopeForIp($query, string $ip)
    {
        return $query->where('ip', $ip);
    }

    public function scopeForUserAgent($query, string $userAgent)
    {
        return $query->where('user_agent', $userAgent);
    }

}
