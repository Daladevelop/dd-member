<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function payable(){
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
