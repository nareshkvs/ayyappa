<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
