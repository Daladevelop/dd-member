<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function createToAll(){
        $recipients = \App\User::all();
        return $this->create($recipients);
    }

    public function createToUser($user_id){
        $recipients = collect([\App\User::find($user_id)]);
        return $this->create($recipients);
    }

    public function createFromGroup($group_id){
        $recipients = \App\MemberGroup::find($group_id)->users;
        return $this->create($recipients);
    }


    public function create($recipients = null){

        return view('mail.create')->with([
            'recipients' =>  $recipients
        ]);

    }
}
