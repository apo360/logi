<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $id = 'role_id';

    protected $fillable = [
        'role_name', 'role_description',
    ];

    // Define the users relationship
    public function users()
    {
        return $this->hasMany(User::class, 'Fk_Role', 'Id');
    }

    // Define the permissions relationship
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
