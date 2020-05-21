<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proflog extends Model
{
    //
    protected $table = 'proflog';
    protected $guarded = array('id');
    
    public static $rules =  array(
        'profile_id' => 'required',
        'edit_at' => 'required',
        );
    
 

}
