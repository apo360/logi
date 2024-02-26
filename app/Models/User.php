<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // No modelo User
    protected $fillable = [
        'name', 'email', 'password', 'password_change_required', 'password_expired', 'FK_Empresa', 'Fk_Role'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function is_new_user()
    {
        return $this->created_at->diffInDays(now()) < 7;
    }

    // Relacionamento com a função do usuário
    public function role()
    {
        return $this->belongsTo(Role::class, 'Fk_Role', 'role_id');
    }

    // Método para verificar se o usuário tem a função de admin
    public function isAdmin()
    {
        return $this->role->role_name === 'Administrator'; // Verifica se o nome da role é 'admin'
    }

    // Método para verificar se o usuário tem a função de admin
    public function isNormal()
    {
        return $this->role->role_name === 'Normal'; // Verifica se o nome da role é 'Normal'
    }

    /**
     * Relacionamento com a empresa
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'FK_Empresa');
    }

    // Define the permissions relationship through roles
    public function permissions()
    {
        return $this->role->permissions();
    }

}
