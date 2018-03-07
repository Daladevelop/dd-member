<?php
namespace App\Helpers\Traits;

trait Payable{
    public function payments(){
        return $this->morphMany(\App\Payment::class,'payable');
    }
}