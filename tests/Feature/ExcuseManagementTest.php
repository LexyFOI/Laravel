<?php

namespace Tests\Feature;

use App\Excuse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExcuseManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_excuse_can_be_added()
    {
        $this->withoutExceptionHandling();

        $this->post('/excuses',[
            'excuse_id'=>'C',
            'description'=>'sportaš',
        ]);

        $this->assertCount(1,Excuse::all());
    }

    /** @test */
    public function an_excuse_id_is_required()
    {
        $response = $this->post('/excuses', [
            'excuse_id'=>'',
            'description'=>'sportaš',
        ]);

        $response->assertSessionHasErrors('excuse_id');
    }

    /** @test */
    public function a_description_is_required()
    {
        $response = $this->post('/excuses', [
            'excuse_id'=>'C',
            'description'=>'',
        ]);

        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function an_excuse_can_be_updated()
    {
       // $this->withoutExceptionHandling();

        $this->post('/excuses', [
            'excuse_id'=>'C',
            'description'=>'sportaš',
        ]);

        $excuse = Excuse::first();
        $response = $this->patch('/excuses/'.$excuse->id,[
            'excuse_id'=>'B',
            'description'=>'liječnička',
        ]);

        $this->assertEquals('liječnička', Excuse::first()->description);
        $this->assertEquals('B', Excuse::first()->excuse_id);
    }

    /** @test */
    public function an_excuse_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/excuses', [
            'excuse_id'=>'C',
            'description'=>'sportaš',
        ]);

        $excuse = Excuse::first();

        $response = $this->delete($excuse->path());

        $this->assertCount(0,Excuse::all());
        $response->assertRedirect('/excuses');

    }
}
