<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Notifications\MailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MailController extends Controller
{
    protected $recipient_string;
    protected $type;
    protected $type_id;

    public function createFromQuery(Request $request){
        if(!$request->type)
            return redirect()->back();
        $this->type = $request->type;

        $this->type_id = $request->id ? $request->id : null;

        switch($request->type){
            case 'to-all':
                return $this->createToAll();
                break;
            case 'to-user':
                // if it does not have a request id it will fall through
                // to default to take care of if id is forgotten.
                if($request->id) {
                    return $this->createToUser($request->id);
                }

            case 'to-group':
                if($request->id) {
                    return $this->createToGroup($request->id);
                }

            default:
                return 'Whoops something went wrong. to send email '.$request->type.' you might need to use the id parameter';

        }
    }

    public function createToAll(){
        $recipients = \App\User::all();
        $this->recipient_string = 'Skicka till alla användare';
        return $this->create($recipients);
    }

    public function createToUser($user_id){
        $recipients = collect([\App\User::find($user_id)]);
        $this->recipient_string = 'Skicka till '.$recipients->first()->name;
        return $this->create($recipients);
    }

    public function createToGroup($group_id){
        $group = \App\MemberGroup::find($group_id);
        $this->recipient_string = 'Skicka till gruppen '.$group->name;
        $recipients = $group->users;
        return $this->create($recipients);
    }

    public function create(Collection $recipients = null){

        return view('mail.create')->with([
            'recipients' =>  $recipients,
            'recipient_string' => $this->recipient_string,
            'type'  => $this->type,
            'type_id' => $this->type_id
        ]);
    }


    public function sendMail(Request $request){
        $recipients = null;
        switch($request->type){
            case 'to-all':
                $recipients = \App\User::all();
                break;
            case 'to-user':
                // if it does not have a request id it will fall through
                // to default to take care of if id is forgotten.
                if($request->type_id) {
                    $recipients = collect([\App\User::find($request->type_id)]);
                }
                break;
            case 'to-group':
                if($request->type_id) {
                    $group = \App\MemberGroup::find($request->type_id);
                    if($group) {
                        $recipients = $group->users;
                    }
                }
                break;
        }
        if(!$recipients){
            return 'something went wrong. have no recipients';
        }

        // @todo create mail model for logging. (And presumably send same mail again)
        // why i did not do it now? Lazy.

        foreach($recipients as $recipient){
            $recipient->notify(new MailNotification(
                $request->subject ? $request->subject : 'Without subject',
                $request->maincontent ? $request->maincontent : 'Without content',
                $request->action ? $request->action : null
            ));
        }
        Helper::message('Skickade mail', 'Vi lyckades skicka mail', 'success');

        //return mail index
        return redirect('/');
    }
}
