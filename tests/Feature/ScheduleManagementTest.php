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

        $response = $this->post('/events', $this->scheduleData());

        $event = Event::first();

       // $response->assertOk();
        $this->assertCount(1,Event::all());
        $response->assertRedirect('/events/'.$event->id);
    }

    /** @test */
    public function a_group_is_required()
    {
        $response = $this->post('/events', array_merge($this->scheduleData(), ['group'=> '']));

        $response->assertSessionHasErrors('group');
    }

    /** @test */
    public function startTime_is_required()
    {
        $response = $this->post('/events', array_merge($this->scheduleData(), ['startTime'=>'']));

        $response->assertSessionHasErrors('startTime');
    }

    /** @test */
    public function endTime_is_required()
    {
        $response = $this->post('/events', array_merge($this->scheduleData(), ['endTime'=>'']));

        $response->assertSessionHasErrors('endTime');
    }

    /** @test */
    public function a_location_is_required()
    {
        $response = $this->post('/events', array_merge($this->scheduleData(), ['location'=>'']));

        $response->assertSessionHasErrors('location');
    }

    /** @test */
    public function an_event_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/events', $this->scheduleData());

        $event = Event::first();
        $this->patch($event->path(),[
            'group'=>'košarka',
            'startTime'=>'10:00',
            'endTime'=>'11:00',
            'location'=>'2. gimnazija',
        ]);

        $this->assertEquals('košarka', Event::first()->group);
        $this->assertEquals('10:00', Event::first()->startTime);
        $this->assertEquals('11:00', Event::first()->endTime);
        $this->assertEquals('2. gimnazija', Event::first()->location);
    }

    /** @test */
    public function an_event_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/events', $this->scheduleData());

        $event = Event::first();

        $response = $this->delete($event->path());

        $this->assertCount(0,Event::all());
        $response->assertRedirect('/events');

    }

    /**
     * @return array
     */
    private function scheduleData(): array
    {
        return [
            'group' => 'badminton',
            'startTime' => '08:00',
            'endTime' => '09:00',
            'location' => 'TTS',
        ];
    }
}
