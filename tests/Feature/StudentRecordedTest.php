<?php

namespace Tests\Feature;

use App\AYear;
use App\Student;
use App\TZKrecord;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StudentRecordedTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_student_can_be_recorded_by_a_signed_in_user()
    {
        $this->withoutExceptionHandling();

        $student = factory(Student::class)->create();
        $ayear = factory(AYear::class)->create();

        $this->actingAs($user=factory(User::class)->create())
            ->post('/recorded/'.$student->id);

        $this->assertCount(1,TZKrecord::all());
        $this->assertEquals($ayear->id, TZKrecord::first()->ayear_id);
        $this->assertEquals($student->id, TZKrecord::first()->student_id);
        $this->assertNull(TZKrecord::first()->excuse_id);
        $this->assertEquals(0,TZKrecord::first()->nof_excused_weeks);
        $this->assertNull(TZKrecord::first()->group_id);
        $this->assertEquals(0,TZKrecord::first()->sumS1);
        $this->assertEquals(0, TZKrecord::first()->satisfiedS1);
        $this->assertEquals(0,TZKrecord::first()->sumS2);
        $this->assertEquals(0, TZKrecord::first()->satisfiedS2);
        $this->assertNull(TZKrecord::first()->evidence_comment);
        $this->assertEquals(1,TZKrecord::first()->yearOFstudy);
        $this->assertEquals(0,TZKrecord::first()->repeater);
    }

    /** @test */
    public function only_signed_in_user_can_record_a_student()
    {
        $student=factory(Student::class)->create();

        $this->post('recorded/'.$student->id)
            ->assertRedirect('/login');

        $this->assertCount(0,TZKrecord::all());
    }
}
