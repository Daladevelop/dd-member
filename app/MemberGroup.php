<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberGroup extends Model
{
    protected $fillable = ['name', 'description'];
    public function users(){
        return $this->belongsToMany(\App\User::class,'member_groups_users');
    }

    public function getMemberCountAttribute(){
        return count($this->users);
    }
}
