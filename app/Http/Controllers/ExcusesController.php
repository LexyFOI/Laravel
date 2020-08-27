<?php

namespace App\Http\Controllers;

use App\Excuse;
use Illuminate\Http\Request;

class ExcusesController extends Controller
{
    public function store(){
        $data = $this->validateRequest();
        Excuse::create($data);
    }

    public function update(Excuse $excuse)
    {
        $excuse->update($this->validateRequest());
        return redirect($excuse->path());
    }

    public function destroy(Excuse $excuse)
    {
        $excuse->delete();
        return redirect('/excuses');
    }

    public function validateRequest()
    {
        return request()->validate([
            'excuse_id' => 'required',
            'description' => 'required',
        ]);
    }
}
