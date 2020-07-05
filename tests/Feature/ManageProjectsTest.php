<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Support\Str;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_projects() {
        //$this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->get($project->path().'/edit')->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project() {

        //$this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'notes' => 'General notes here.'
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();
        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee(Str::limit($attributes['description'], 100))
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_update_a_project() {
        $this->signIn();

        //$this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->get($project->path() . '/edit')->assertOk();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
            'notes' => 'Changed',
            'title' => 'Title changed!',
            'description' => 'Pluuuuuus'
        ])->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_update_projects_general_notes() {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
            'notes' => 'Changed'
        ]);

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_the_projects_of_others() {
        $this->signIn();

        //$this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }

    /** @test */
    public function a_user_can_view_their_project() {
        
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee(Str::limit($project->description, 100));
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others() {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title() {

        $this->signIn();

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description() {

        $this->signIn();

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_projects() {
        $project = ProjectFactory::create();

        $this->delete($project->path())
            ->assertRedirect('/login');

        $this->signIn();

        $this->delete($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_can_delete_a_project() {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path());

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    
}
