<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

	protected $fillable = [
        'nombre',
    ];


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

     public function tool()
    {
        return $this->hasMany('App\Tool');
    }


    public static function getsubcategories($id){
        return Subcategory::where('category_id','=',$id)
        ->get();
    }

}
