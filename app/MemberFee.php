<?php

namespace App;

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
}
