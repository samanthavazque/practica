<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Usuario extends Model
{
    use HasFactory;

    // Asegúrate de que 'fecha_registro' está en el array de fechas
    
    protected $dates = ['fecha_registro']; 
    
    protected $fillable = ['nombre', 'curp', 'edad', 'email', 'password', 'foto', 'pokemon_favorito'];

    protected $appends = ['edad'];

    public function getEdadAttribute()
    {
        return $this->calcularEdadDesdeCurp();
    }

    private function calcularEdadDesdeCurp()
    {
        if (strlen($this->curp) < 10) {
            return null; // Evitar errores si el CURP no es válido
        }

        $anio = substr($this->curp, 4, 2);
        $mes = substr($this->curp, 6, 2);
        $dia = substr($this->curp, 8, 2);

        $anio_completo = ($anio >= '00' && $anio <= date('y')) ? "20$anio" : "19$anio";

        $fechaNacimiento = "$anio_completo-$mes-$dia";

        return Carbon::parse($fechaNacimiento)->age;
    }


    protected $hidden = [
        'password',
    ];
}
