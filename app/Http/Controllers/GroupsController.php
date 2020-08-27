<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function store()
    {
        Group::create($this->validateRequest());
    }

    public function update(Group $group)
    {
        $group->update($this->validateRequest());
        return redirect($group->path());
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect('/groups');
    }

    /**
     * @return array
     */
    private function validateRequest(): array
    {
        return request()->validate([
            'group_name' => 'required',
            'points' => 'required',
        ]);
    }

}
