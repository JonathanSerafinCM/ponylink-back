<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'profile_photo_path', // {{ Agregado para permitir la asignación masiva }}
        'ubicacion',
        'sobre_mi_titulo',
        'sobre_mi_contenido'
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
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Relación con el modelo Habilidades.
     */
    public function habilidades()
    {
        return $this->hasMany(Habilidades::class, 'usuario_id');
    }

    public function experienciaLaboral(){
        return $this->hasMany(Experiencia_laboral::class, 'usuario_id');
    }
    public function workExperiences()
{
    return $this->hasMany(Experiencia_laboral::class, 'usuario_id');
}

    public function educacion(){
        return $this->hasMany(Educacion::class, 'usuario_id');
    }

    public function idioma()
    {
        return $this->hasMany(Idiomas::class, 'usuario_id');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
}
