<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    use HasFactory;

    protected $table = 'educacion';

    protected $fillable = [
        'institucion',
        'titulo_grado',
        'campo_estudio',
        'fecha_inicio',
        'fecha_fin', // Changed from fecha_finalizacion
        'descripcion'
    ];

    public function educacion()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
