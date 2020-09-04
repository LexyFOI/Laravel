<?php

namespace Tests\Feature;

use App\Excuse;
use App\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
                'course_id'=>'1',
            ]);

        $this->assertEquals('21365487902', Student::first()->oib);
        $this->assertEquals('Maja', Student::first()->student_name);
        $this->assertEquals('Borošić', Student::first()->student_last_name);
        $this->assertEquals('mborosic@foi.hr',Student::first()->email);
        $this->assertEquals('1', Student::first()->course_id);
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

    //a student can be enrolled in to a group of held hour

    //upisom u atribut 'excuse_id' vrijednosti koja odgovara liječničkoj ispričnici
    // skaće izrada ispričnice (Apology) te se moraju upisati podaci
    /** @test */
   /** public function check_if_an_apology_needs_to_be_added()
    {
        $this->post('/students', $this->studentData());

        $student_excuse = Student::first()->excuse_id;

        if($student_excuse == 1){
            echo "Potrebno je dodati ispričnicu u bazu!!";
        }



    } */

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
            'course_id' => '2',
        ];
    }
}
