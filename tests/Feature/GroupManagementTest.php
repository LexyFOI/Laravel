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
        $this->post('/groups', $this->groupData());

        $this->assertCount(1,Group::all());
    }

    /** @test */
    public function a_group_can_be_updated()
    {
        $this->post('/groups', $this->groupData());

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
        $this->post('/groups', $this->groupData());

        $group = Group::first();

        $response = $this->delete($group->path());

        $this->assertCount(0, Group::all());
        $response->assertRedirect('/groups');
    }

    /**
     * @return array
     */
    private function groupData(): array
    {
        return [
            'group_name' => 'B1_badminton',
            'points' => 0,
        ];
    }
}
