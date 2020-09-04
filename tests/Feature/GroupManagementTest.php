<?php

namespace Tests\Feature;

use App\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
            'group_name' => 'B2_badminton',
            'location_id'=>'2',
            'startTime'=>'09:00',
            'endTime'=>'10:00',
            'group_points' => 1.5,
            'organizer'=> 'FOI',
        ]);

        $this->assertEquals('B2_badminton', Group::first()->group_name);
        $this->assertEquals(2, Group::first()->location_id);
        $this->assertEquals('09:00',Group::first()->startTime);
        $this->assertEquals('10:00',Group::first()->endTime);
        $this->assertEquals(1.5, Group::first()->group_points);
        $this->assertEquals('FOI', Group::first()->organizer);
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
            'location_id'=>'1',
            'startTime'=>'08:00',
            'endTime'=>'09:00',
            'group_points' => 0,
            'organizer'=> 'FOI',
        ];
    }
}
