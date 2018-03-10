<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\MemberGroup;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(){
        return view('groups.index')->with([
               'groups' => MemberGroup::all()
            ]);
    }

    public function create(){
        return view('groups.edit')->with([
            'group' => null
        ]);
    }

    public function store(Request $request){
        $group = new MemberGroup();
        $group->fill($request->all());
        $group->save();
        return redirect()->route('groups.index');
    }

    public function edit($id){
        $group = MemberGroup::find($id);
        $users = \App\User::all()->pluck('name','id');
        $users[0] = 'Välj en användare';
        $users = $users->sort()->toArray();



        return view('groups.edit')->with([
            'group' => $group,
            'users' => $users
        ]);
    }

    public function update($id, Request $request){
        $group = MemberGroup::find($id);
        $group->fill($request->all());
        $group->save();
        return redirect()->route('groups.edit', $group->id);
    }

    public function addGroupMember($group_id, Request $request){
        $group = MemberGroup::find($group_id);
        $user = \App\User::find($request->user_id);
        if($group && $user){
            if(!$group->users->contains($user)){
                $group->users()->attach($user);
            }
        }
        return redirect()->back();
    }

    public function removeGroupMember($group_id, $user_id){
        if($user = \App\User::find($user_id)){
            $user->groups()->detach($group_id);
            Helper::message('Användare borttagen från grupp', $user->name.' är borttagen från gruppen', 'success');
            return redirect()->back();
        }
        return redirect()->back();
    }
}
