<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'nombre', 'imagen', 'descripcion','subcategory_id','cantidad_disponible','category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
    public function users()
    {
        return $this->belongsToMany('App\User')
        ->withPivot('id')
        ->withPivot('f_devolucion')
        ->withPivot('aprobada')
        ->withPivot('justificacion')
        ->withPivot('observacion')
        ->withTimestamps();
    }

    public function scopeNombre($query, $nombre)
    {
        if (trim($nombre) != "") {
            $query->where('nombre', 'LIKE' ,"%$nombre%");
        }
        
    }

    public function scopeCategoria($query, $category_id)
    {
        if (trim($category_id) != "") {
            $query->where('category_id', '=' ,$category_id);
        }
        
    }

    public function petition_tool()
    {
        return $this->hasOne('App\PetitionTool');
    }


}
