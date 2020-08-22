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
            'mark'=>'B1',
            'name'=>'badminton',
            'points'=>1,
        ]);

        $this->assertCount(1,Group::all());
    }
}
