<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Traits\Payable;

class Memberfee extends Model
{
    use Payable;

    protected $fillable = ['year', 'amount', 'amount_student', 'amount_child'];

    // Can we do this in SQL, i.e.
    // getting both paid and unpaid and total count in one query?
    public function number_paid()
    {
        return $this->payments()->whereNotNull('payment_date')->count();
    }

    public function number_unpaid()
    {
        return $this->payments()->whereNull('payment_date')->count();
    }

    public static function has_yearly_fee(){
        return self::get_yearly_fee() ? true : false;
    }
    public static function get_yearly_fee(){
        return self::where('year',date('Y'))->get()->first();
    }
}
