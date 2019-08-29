<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tipo','cc','telefono'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tools()
    {
        return $this->belongsToMany('App\Tool')
        ->withPivot('id')
        ->withPivot('f_devolucion')
        ->withPivot('aprobada')
        ->withPivot('justificacion')
        ->withPivot('observacion')
        ->withTimestamps();
    }

    public function petitions()
    {
        return $this->hasMany('App\Petition');
    }

    


}
