<?php

namespace App\Models;

use App\Models\BlogLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $withCount = [
        'likes',
    ];

    public function likes(): HasMany
    {
        return $this->hasMany(BlogLike::class);
    }

    public function isLiked(): bool
    {
        if (auth()->user()) {
            return auth()->user()->likes()->forBlog($this)->count();
        }

        if (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            return $this->likes()->forIp($ip)->forUserAgent($userAgent)->count();
        }

        return false;
    }

    public function removeLike(): bool
    {
        if (auth()->user()) {
            return auth()->user()->likes()->forBlog($this)->delete();
        }

        if (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            return $this->likes()->forIp($ip)->forUserAgent($userAgent)->delete();
        }

        return false;
    }


}
