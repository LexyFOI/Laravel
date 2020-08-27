<?php

namespace App\Http\Controllers;

use App\Apology;
use Illuminate\Http\Request;

class ApologiesControlller extends Controller
{
    public function store()
    {
        Apology::create($this->validateRequest());
    }

    public function update(Apology $apology)
    {
        $apology->update($this->validateRequest());
    }

    public function destroy(Apology $apology)
    {
        $apology->delete();
        return redirect('/apologies');
    }

    /**
     * @return array
     */
    private function validateRequest(): array
    {
        return request()->validate([
            'student_id' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'nof_weeks' => 'required',
            'comment' => 'required',
        ]);
    }
}
