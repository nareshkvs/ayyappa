<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Temple extends Model
{
    use HasFactory;

    public $table = 'temples';

    protected $fillable = [
        'name', 'description', 'slug', 'photo', 'visibility', 'status', 'featured', 'address', 'city', 'state', 'zipcode', 'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('parent_id', '=', 0);
    }

}
