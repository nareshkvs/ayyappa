<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $table = 'groups';

    public $fillable = [
        'id', 'name', 'code'
    ];

    // Group belongs to many Roles
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'group_role')->withTimestamps();
    }
}
