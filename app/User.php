<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','city', 'phone', 'personal_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $with = [
        'groups'
    ];

    protected $member_types = ['Ordinarie', 'Student', 'Barn'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments() {
        return $this->hasMany(\App\Payment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrations(){
        return $this->hasMany(\App\Registration::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups(){
        return $this->belongsToMany(\App\MemberGroup::class,'member_groups_users');
    }

    public function isValidMemberType($member_type)
    {
        return in_array($member_type,$this->member_types);
    }

    public function hasPaidThisYearsMemberFee(){
        if(!count($this->payments)){
            return false;
        }
        $memberFeePayments = $this->payments()->where('payable_type', '=','\App\Memberfee')->get();
        if($memberFeePayments->count()){
            $thisYears = $memberFeePayments->filter(function($payment){
               return ($payment->payable->year == date('Y'));
            });
            return $thisYears->first()->is_paid;
        }
    }
}
