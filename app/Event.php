<?php

namespace App;

use App\Helpers\Traits\Payable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Payable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'start_date','end_date', 'cost', 'max_participants', 'members_only'
    ];

    
}
