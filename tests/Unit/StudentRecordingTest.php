<?php

namespace Tests\Unit;

use App\AYear;
use App\Student;
use App\TZKrecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentRecordingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
   public function a_student_can_be_recorded_in_the_academic_year()
   {
       $this->withoutExceptionHandling();
       $student = factory(Student::class)->create();
       $ayear = factory(AYear::class)->create();

       $student->recorded($ayear);

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
   public function the_student_cant_be_added_more_then_once_in_the_same_academic_yer()
   {
       $this->expectException(\Exception::class);

       $student = factory(Student::class)->create();
       $ayear = factory(AYear::class)->create();

       $student->recorded($ayear);

       $this->assertCount(1,TZKrecord::all());

       $student->recorded($ayear);

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
}
