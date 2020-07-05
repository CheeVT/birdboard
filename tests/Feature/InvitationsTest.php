<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user() {
        $project = ProjectFactory::create();

        $project->invite($newUser = factory(User::class)->create());

        $this->actingAs($newUser)
            ->post($project->path() . '/tasks', $task = ['body' => 'Foo task']);
        //dd($task);
        $this->assertDatabaseHas('tasks', $task);
    }
}
