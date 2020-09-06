<?php

namespace Tests\Unit;

use App\Group;
use App\HourHeld;
use App\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentEnrollmentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_student_can_be_enrolled()
    {
        $this->withoutExceptionHandling();
        $student = factory(Student::class)->create();
        $group = factory(Group::class)->create();

        $student->enrolled($group);

        $this->assertCount(1,HourHeld::all());
        $this->assertEquals($student->id, HourHeld::first()->student_id);
        $this->assertEquals($group->id, HourHeld::first()->group_id);
        $this->assertEquals(now(), HourHeld::first()->hs_date);
        $this->assertEquals(now()->localeDayOfWeek, HourHeld::first()->hs_day);
    }

    /** @test */
    public function a_student_cant_be_enrolled_more_then_once_per_day_at_the_same_group(){
        //$this -> withExceptionHandling();
        $this->expectException(\Exception::class);

        $student = factory(Student::class)->create();
        $group = factory(Group::class)->create();

        $student->enrolled($group);


        $this->assertCount(1,HourHeld::all());
        $this->assertEquals($student->id, HourHeld::first()->student_id);
        $this->assertEquals($group->id, HourHeld::first()->group_id);
        $this->assertEquals(now(), HourHeld::first()->hs_date);

        $student->enrolled($group);

        $this->assertCount(1,HourHeld::all());
        $this->assertEquals($student->id, HourHeld::first()->student_id);
        $this->assertEquals($group->id, HourHeld::first()->group_id);
        $this->assertEquals(now(), HourHeld::first()->hs_date);
    }
}
