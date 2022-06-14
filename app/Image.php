<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'images';


    /**
     * Get the phone associated with the user.
     */ 
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
   
}
