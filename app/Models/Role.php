<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public $table = 'roles';

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'guard_name' => 'web',
     ];

    public $fillable = [
        'name'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    // Role belongs to many Groups
    public function groups()
    {
        return $this->belongsToMany(\App\Models\Group::class);
    }

}
