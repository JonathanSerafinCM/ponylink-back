<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta_trabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'titulo',
        'descripcion',
        'empresa',
        'ubicacion',
        'habilidades_requeridas',
        'fecha_expiracion',
    ];

    public function solicitudes()
    {
        return $this->hasMany(Solicitudes_Trabajo::class, 'oferta_trabajo_id');
    }
}