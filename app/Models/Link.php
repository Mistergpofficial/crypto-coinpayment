<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['id', 'user_id', 'username', 'address'];


    public function user(){

        return $this->belongsTo(\App\User::class);
       // return $this->belongsTo('App\User');
    }

}
