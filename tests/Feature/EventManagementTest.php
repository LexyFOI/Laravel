<?php

namespace Tests\Feature;

use App\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_event_can_be_added()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/events', $this->eventData());

        $event = Event::first();

       // $response->assertOk();
        $this->assertCount(1,Event::all());
        $response->assertRedirect('/events/'.$event->id);
    }

    /** @test */
    public function a_event_name_is_required()
    {
        $response = $this->post('/events', array_merge($this->eventData(), ['event_name'=> '']));

        $response->assertSessionHasErrors('event_name');
    }

    /** @test */
    public function startDate_is_required()
    {
        $response = $this->post('/events', array_merge($this->eventData(), ['startDate'=>'']));

        $response->assertSessionHasErrors('startDate');
    }

    /** @test */
    public function endDate_is_required()
    {
        $response = $this->post('/events', array_merge($this->eventData(), ['endDate'=>'']));

        $response->assertSessionHasErrors('endDate');
    }

    /** @test */
    public function a_payment_is_required()
    {
        $response = $this->post('/events', array_merge($this->eventData(), ['payment'=>'']));

        $response->assertSessionHasErrors('payment');
    }

    /** @test */
    public function a_price_is_required()
    {
        $response = $this->post('/events', array_merge($this->eventData(), ['price'=>'']));

        $response->assertSessionHasErrors('price');
    }

    /** @test */
    public function an_event_points_are_required()
    {
        $response = $this->post('/events', array_merge($this->eventData(), ['event_points'=>'']));

        $response->assertSessionHasErrors('event_points');
    }

    /** @test */
    public function a_event_description_is_required()
    {
        $response = $this->post('/events', array_merge($this->eventData(), ['event_description'=>'']));

        $response->assertSessionHasErrors('event_description');
    }

    /** @test */
    public function an_event_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/events', $this->eventData());

        $event = Event::first();
        $this->patch($event->path(),[
            'event_name'=>'paintball',
            'startDate'=>'12.06.2020.',
            'endDate'=>'12.06.2020.',
            'payment'=>true,
            'price' => 60,
            'event_points'=>8.5,
            'event_description' => 'aaa',
        ]);

        $this->assertEquals('paintball', Event::first()->event_name);
        $this->assertEquals('12.06.2020.', Event::first()->startDate);
        $this->assertEquals('12.06.2020.', Event::first()->endDate);
        $this->assertEquals(true, Event::first()->payment);
        $this->assertEquals('60', Event::first()->price);
        $this->assertEquals(8.5, Event::first()->event_points);
        $this->assertEquals('aaa', Event::first()->event_description);


    }

    /** @test */
    public function an_event_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/events', $this->eventData());

        $event = Event::first();

        $response = $this->delete($event->path());

        $this->assertCount(0,Event::all());
        $response->assertRedirect('/events');

    }

    /**
     * @return array
     */
    private function eventData(): array
    {
        return [
            'event_name' => 'paintball',
            'startDate' => '16.087.2020.',
            'endDate' => '16.07.2020.',
            'payment' => true,
            'price' => 50,
            'event_points'=>9,
            'event_description' => 'asd',
        ];
    }
}
