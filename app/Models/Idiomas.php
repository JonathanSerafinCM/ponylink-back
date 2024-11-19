<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idiomas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nivel_dominio',
        'certificacion_opcional'
    ];

    /**
     * Relación con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
