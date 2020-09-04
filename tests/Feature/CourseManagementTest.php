<?php

namespace Tests\Feature;

use App\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_course_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/courses', $this->courseData());

        $this->assertCount(1,Course::all());

        $response->assertRedirect('/courses/'.Course::first()->id);
    }

    /**  @test */
    public function a_course_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/courses',$this->courseData());

        $course = Course::first();
        $this->patch($course->path(),[
            'course_shortName'=>'EP',
            'course_longName'=>'Ekonomika poduzetništva',
        ]);

        $this->assertEquals('EP', Course::first()->course_shortName);
        $this->assertEquals('Ekonomika poduzetništva', Course::first()->course_longName);
    }

    /** @test */
    public function a_course_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->post('/courses', $this->courseData());

        $course = Course::first();

        $response= $this->delete($course->path());

        $this->assertCount(0,Course::all());
        $response->assertRedirect('/courses');
    }

    public function courseData()
    {
        return[
            'course_shortName'=>'PITUP',
            'course_longName'=>'Primjena informacijske tehnologije u poslovanju',
        ];
    }
}
