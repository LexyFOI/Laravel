<?php

namespace Tests\Feature;

use App\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_student_can_be_created()
    {
        $response = $this->post('/students', $this->studentData());

        $this->assertCount(1,Student::all());

        $response->assertRedirect('/students/'.Student::first()->id);

    }

    /**  @test */
    public function a_student_can_be_updated()
    {
        $this->post('/students',$this->studentData());

        $student = Student::first();
        $this->patch($student->path(),[
                'oib'=>'21365487902',
                'student_name'=>'Maja',
                'student_last_name'=>'Borošić',
                'email'=>'mborosic@foi.hr',
                'year'=>'2',
                'course_id'=>'PITUP',
                'excuse_id'=>'1',
                'group_id'=>1,
                'no_excused_weekends'=>1,
                'no_workd_hours'=>1,
                'comment'=>'asd',
            ]);

        $this->assertEquals('21365487902', Student::first()->oib);
        $this->assertEquals('Maja', Student::first()->student_name);
        $this->assertEquals('Borošić', Student::first()->student_last_name);
        $this->assertEquals('mborosic@foi.hr',Student::first()->email);
        $this->assertEquals('2', Student::first()->year);
        $this->assertEquals('PITUP', Student::first()->course_id);
        $this->assertEquals('1', Student::first()->excuse_id);
        $this->assertEquals('1', Student::first()->group_id);
        $this->assertEquals('1', Student::first()->no_excused_weekends);
        $this->assertEquals('1', Student::first()->no_workd_hours);
        $this->assertEquals('asd', Student::first()->comment);
    }

    /** @test */
    public function a_student_can_be_deleted()
    {
        $this->post('/students', $this->studentData());

        $student = Student::first();

        $response= $this->delete($student->path());

        $this->assertCount(0,Student::all());
        $response->assertRedirect('/students');

    }

    /**
     * @return array
     */
    private function studentData(): array
    {
        return [
            'oib' => '12365478901',
            'student_name' => 'Aleksandra',
            'student_last_name' => 'Tomić',
            'email' => 'apolak@foi.hr',
            'year' => '2',
            'course_id' => 'BPBZ',
            'excuse_id' => '0',
            'group_id' => 1,
            'no_excused_weekends' => 0,
            'no_workd_hours' => 0,
            'comment' => 'blabla',
        ];
    }
}
