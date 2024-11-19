<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilidades extends Model
{
    use HasFactory;


    protected $fillable = [
        'nombre',
        'tipo_habilidad'
    ];

    /**
     * Relación con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
