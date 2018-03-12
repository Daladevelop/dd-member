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

    public function save(array $options = [])
    {
        if(!$this->ocr) {
            $this->ocr = $this->generateOCR();
        }

        return parent::save($options);
    }

    public function generateOCR($offset = 0){
        // TODO generate proper OCR.
        // This one is not intented to be used by swedish banks as "OCR NUMMER" but
        // it can be used as "betalningsreferens"
        $ocr='';
        if($this->user){
            $ocr.= substr($this->user->personal_number,0,-4);
        }
        $ocr.=date('m');
        if($offset)
        {
            $ocr.=$offset;
        }

        if(\App\Payment::where('ocr', $ocr)->count())
            return $this->generateOCR($offset+1);
        return $ocr;
    }
}
