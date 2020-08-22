<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'mark_id'=> 'required',
            'name'=>'required',
            'points'=>'required',
        ]);
        Group::create($data);
    }

    public function update(Group $group)
    {
        $data = request()->validate([
            'mark_id'=> 'required',
            'name'=>'required',
            'points'=>'required',
        ]);

        $group->update($data);

        return redirect($group->path());
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect('/groups');
    }

}
