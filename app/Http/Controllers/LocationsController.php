<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function store()
    {
        $location = Location::create($this->validateRequest());

        return redirect($location->path());
    }

    public function update(Location $location){
        $location->update($this->validateRequest());

        return redirect($location->path());
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect('/locations');
    }

    private function validateRequest()
    {
        return request()->validate([
            'location_name'=>'',
            'address'=>'',
        ]);
    }

}
