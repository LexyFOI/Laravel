<?php

namespace Tests\Feature;

use App\Apology;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApologyManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_apology_can_be_created()
    {
        $this->post('/apologies', $this->apologyData());

        $this->assertCount(1,Apology::all());
    }

    /** @test */
    public function an_apology_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/apologies',$this->apologyData());

        $this->patch('/apologies/'.Apology::first()->id , [
            'student_id'=>2,
            'valid_from'=>'25.08.2020.',
            'valid_to'=>'17.09.2020.',
            'nof_weeks'=>'3',
            'comment'=>'asd',
        ]);

        $this->assertEquals(2,Apology::first()->student_id);
        $this->assertEquals('25.08.2020.',Apology::first()->valid_from);
        $this->assertEquals('17.09.2020.',Apology::first()->valid_to);
        $this->assertEquals('3',Apology::first()->nof_weeks);
        $this->assertEquals('asd',Apology::first()->comment);
    }

    /** @test */
    public function an_apology_can_be_deleted()
    {
        $this->post('/apologies',$this->apologyData());

        $apology = Apology::first();
        $response = $this->delete($apology->path());

        $this->assertCount(0,Apology::all());

        $response->assertRedirect('/apologies');
    }

    /**
     * @return array
     */
    private function apologyData(): array
    {
        return [
            'student_id' => '1',
            'valid_from' => '12.08.2020.',
            'valid_to' => '12.09.2020.',
            'nof_weeks' => '4',
            'comment' => 'abc',
        ];
    }
}
