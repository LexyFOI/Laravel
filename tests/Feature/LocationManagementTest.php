<?php

namespace Tests\Feature;

use App\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_location_can_be_created()
    {
        $this->withoutExceptionHandling();
        $location = $this->post('/locations', $this->locationData());

        $this->assertCount(1,Location::all());

        $location->assertRedirect('/locations/'.Location::first()->id);
    }

    /**  @test */
    public function a_location_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/locations',$this->locationData());

        $location = Location::first();
        $this->patch($location->path(),[
            'location_name'=>'2. gimnazija',
            'address'=>'Đure Deželića 5',
        ]);

        $this->assertEquals('2. gimnazija', Location::first()->location_name);
        $this->assertEquals('Đure Deželića 5', Location::first()->address);
    }

    /** @test */
    public function a_location_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->post('/locations', $this->locationData());

        $location = Location::first();

        $response= $this->delete($location->path());

        $this->assertCount(0,Location::all());
        $response->assertRedirect('/locations');
    }

    public function locationData()
    {
        return[
            'location_name'=>'Plesni klub B&D',
            'address'=>'Trg Matije Gupca 1',
        ];
    }
}
