<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nombre',
    ];


    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }

    public function tools()
    {
        return $this->hasMany('App\Tool');
    }


}
