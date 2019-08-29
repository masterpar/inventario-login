<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetitionTool extends Model
{
    protected $fillable = [
        'cantidad','petition_id','tool_id','cantidad_aprobada'
    ];


    public function petition()
    {
        return $this->belongsTo('App\Petition');
    }

    public function tool()
    {
        return $this->belongsTo('App\Tool');
    }




}
