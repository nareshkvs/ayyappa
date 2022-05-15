<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends SpatieRole
{
    public $table = 'roles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $attributes = [
        'guard_name' => 'web',
     ];

    public $fillable = [
        'name',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    /* protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string',
        'type' => 'string'
    ]; */

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    /* public function modelHasRole()
    {
        return $this->hasOne(\App\Models\ModelHasRole::class);
    } */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    /* public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'role_has_permissions');
    } */

    // Role belongs to many Groups
    public function groups()
    {
        return $this->belongsToMany(\App\Models\Group::class);
    }

}
