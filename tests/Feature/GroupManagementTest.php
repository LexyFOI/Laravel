<?php

namespace Tests\Feature;

use App\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_group_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/groups',[
            'mark_id'=>'B1',
            'group_name'=>'B1_badminton',
            'points'=>0,
        ]);

        $this->assertCount(1,Group::all());
    }

    /** @test */
    public function a_group_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/groups', [
            'group_name'=>'B1_badminton',
            'points'=>0,
        ]);

        $group = Group::first();
        $response = $this->patch('/groups/'.$group->id,[
            'group_name'=>'B2_badminton',
            'points'=>1,
        ]);

        $this->assertEquals('B2_badminton', Group::first()->group_name);
        $this->assertEquals(1, Group::first()->points);
    }

    /** @test */
    public function a_group_can_be_deleted()
    {
        //$this->withoutExceptionHandling();

        $this->post('/groups', [
            'group_name'=>'B2_badminton',
            'points'=>1,
        ]);

        $group = Group::first();

        $response = $this->delete($group->path());

        $this->assertCount(0, Group::all());
        $response->assertRedirect('/groups');
    }
}
