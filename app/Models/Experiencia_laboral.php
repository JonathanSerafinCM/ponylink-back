<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia_laboral extends Model
{
    use HasFactory;

    protected $table = 'experiencia_laboral';

    protected $fillable = [
        'empresa',
        'cargo',
        'fecha_inicio',
        'fecha_finalizacion' ,
        'descripcion' 
    ];

    public function experienciaLaboral(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
