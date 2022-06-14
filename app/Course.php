<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class Course extends Model
{
    //
    protected $table = 'courses'; 
    protected $primaryKey = 'id'; 

    //protected $fillable = [];


    public function image()
    {
        return $this->hasOne('App\Image', 'id');
    }
    
}
