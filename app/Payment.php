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

    public function getIsPaidAttribute(){
        return !empty($this->payment_date);
    }


    public function save(array $options = [])
    {
        $save_success = parent::save($options);

        if ($save_success) {
            if(!$this->ocr) {
                $this->ocr = $this->generateOCR();
            }
            return parent::save();
        }
        else {
            return $save_success;
        }
    }

    protected function luhnChecksum($code) {
        $len = strlen($code);
        $parity = $len % 2;
        $sum = 0;
        for ($i = $len - 1; $i >= 0; $i-- )
        {
            $d = intval($code[$i]);
            if (($i % 2) == $parity) {
                $d = $d * 2;
            }
            if ($d > 9) {
                $d = $d - 9;
            }
            $sum = $sum + $d;
        }
        return $sum % 10;
    }

    protected function luhnCalculate($partcode) {
        $checksum = $this->luhnChecksum($partcode . "0");
        return $checksum == 0 ? 0 : 10 - $checksum;
    }

    public function generateOCR(){
        // TODO generate proper OCR.
        // This one is not intented to be used by swedish banks as "OCR NUMMER" but
        // it can be used as "betalningsreferens"
        $ocr='';
        if($this->user){
            $ocr.= substr($this->user->personal_number,0,-4);
        }
        $ocr.=date('Ym');
        $ocr.=str_pad($this->id, 6, '0', STR_PAD_LEFT);
        $ocr.= $this->luhnCalculate($ocr);
        return $ocr;
    }
}
