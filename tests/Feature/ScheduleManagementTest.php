<?php

namespace Tests\Feature;

use App\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_event_can_be_added()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/events', [
            'group'=>'badminton',
            'startTime'=>'08:00',
            'endTime'=>'09:00',
            'location'=>'TTS',
            'capacity'=>10,
        ]);

        $response->assertOk();
        $this->assertCount(1,Event::all());
    }

    /** @test */
    public function a_group_is_required()
    {
        $response = $this->post('/events', [
            'group'=>'',
            'startTime'=>'08:00',
            'endTime'=>'09:00',
            'location'=>'TTS',
            'capacity'=>10,
        ]);

        $response->assertSessionHasErrors('group');
    }

    /** @test */
    public function startTime_is_required()
    {
        $response = $this->post('/events', [
            'group'=>'badminton',
            'startTime'=>'',
            'endTime'=>'09:00',
            'location'=>'TTS',
            'capacity'=>10,
        ]);

        $response->assertSessionHasErrors('startTime');
    }

    /** @test */
    public function endTime_is_required()
    {
        $response = $this->post('/events', [
            'group'=>'badminton',
            'startTime'=>'08:00',
            'endTime'=>'',
            'location'=>'TTS',
            'capacity'=>10,
        ]);

        $response->assertSessionHasErrors('endTime');
    }

    /** @test */
    public function a_location_is_required()
    {
        $response = $this->post('/events', [
            'group'=>'badminton',
            'startTime'=>'08:00',
            'endTime'=>'09:00',
            'location'=>'',
            'capacity'=>10,
        ]);

        $response->assertSessionHasErrors('location');
    }

    /** @test */
    public function a_capacity_is_required()
    {
        $response = $this->post('/events', [
            'group'=>'badminton',
            'startTime'=>'08:00',
            'endTime'=>'09:00',
            'location'=>'TTS',
            'capacity'=>'',
        ]);

        $response->assertSessionHasErrors('capacity');
    }

    /** @test */
    public function an_event_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/events', [
            'group'=>'badminton',
            'startTime'=>'08:00',
            'endTime'=>'09:00',
            'location'=>'TTS',
            'capacity'=>10,
        ]);

        $event = Event::first();
        $response = $this->patch('/events/'.$event->id,[
            'group'=>'košarka',
            'startTime'=>'10:00',
            'endTime'=>'11:00',
            'location'=>'2. gimnazija',
            'capacity'=>15,
        ]);

        $this->assertEquals('košarka', Event::first()->group);
        $this->assertEquals('10:00', Event::first()->startTime);
        $this->assertEquals('11:00', Event::first()->endTime);
        $this->assertEquals('2. gimnazija', Event::first()->location);
        $this->assertEquals('15', Event::first()->capacity);

    }
}
