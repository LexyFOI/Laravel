<?php

namespace Tests\Feature;

use App\AYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademicYearManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_academic_year_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/ayears', $this->ayearData());

        $this->assertCount(1,AYear::all());

        $response->assertRedirect('/ayears/'.AYear::first()->id);
    }

    /**  @test */
    public function an_academic_year_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/ayears',$this->ayearData());

        $ayear = AYear::first();
        $this->patch($ayear->path(),[
            'ayear'=>'2019./2020.',
            'course_id'=>2,
            'semestar1_start'=>'28.09.2019.',
            'semestar1_end'=>'29.01.2020.',
            'semestar2_start'=>'01.03.2020.',
            'semestar2_end'=>'18.06.2020.',
        ]);

        $this->assertEquals('2019./2020.', AYear::first()->ayear);
        $this->assertEquals('2', AYear::first()->course_id);
        $this->assertEquals('28.09.2019.', AYear::first()->semestar1_start);
        $this->assertEquals('29.01.2020.', AYear::first()->semestar1_end);
        $this->assertEquals('01.03.2020.', AYear::first()->semestar2_start);
        $this->assertEquals('18.06.2020.', AYear::first()->semestar2_end);


    }

    /** @test */
    public function an_academic_year_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->post('/ayears', $this->ayearData());

        $ayear = AYear::first();

        $response= $this->delete($ayear->path());

        $this->assertCount(0,AYear::all());
        $response->assertRedirect('/ayears');
    }

    public function ayearData()
    {
        return[
            'ayear'=>'2020./2021.',
            'course_id'=>1,
            'semestar1_start'=>'28.09.2020.',
            'semestar1_end'=>'29.01.2021.',
            'semestar2_start'=>'01.03.2021.',
            'semestar2_end'=>'18.06.2021.',
        ];
    }
}
