<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
	protected $fillable = [
        'nombre','justificacion','f_devolucion','observacion','observacion_admin','f_devolucion_real','f_aprobada','f_apartada'
    ];



    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function petition_tools()
    {
        return $this->hasMany('App\PetitionTool');
    }
}
