<?php

namespace Tests\Feature;

use App\Group;
use App\HourHeld;
use App\Student;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentEnrolledTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_student_can_be_enrolled_in_the_group()
    {
        $this->withoutExceptionHandling();
        $student = factory(Student::class)->create();
        $group = factory(Group::class)->create();

        $this->actingAs($user = factory(User::class)->create())
            ->post('/enrolled/'.$student->id);

        $this->assertCount(1,HourHeld::all());
        $this->assertEquals($student->id, HourHeld::first()->student_id);
        $this->assertEquals($group->id, HourHeld::first()->group_id);
        $this->assertEquals(now(), HourHeld::first()->hs_date);
        $this->assertEquals(now()->localeDayOfWeek, HourHeld::first()->hs_day);

    }

    /** @test */
    public function only_signed_in_user_can_enrolled_a_student()
    {
       // $this -> withoutExceptionHandling();
        $student = factory(Student::class)->create();
        //$group = factory(Group::class)->create();

        $this->post('enrolled/'. $student->id)
            ->assertRedirect('/login');

        $this->assertCount(0, HourHeld::all());
    }
}
