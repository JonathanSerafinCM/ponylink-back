<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Oferta_Trabajo;

class Solicitudes_Trabajo extends Model
{
    use HasFactory;

    public function ofertas(){
        return $this->belongsTo(Oferta_Trabajo::class, 'oferta_trabajo_id');
    }
}

