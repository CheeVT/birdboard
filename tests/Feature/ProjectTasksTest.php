<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
   use WithFaker, RefreshDatabase;

   /** @test */
   public function guests_cannot_add_tasks_to_projects() {
      $project = factory('App\Project')->create();

      $this->post($project->path() . '/tasks')->assertRedirect('login');
   }

   /** @test */
   public function only_the_owner_of_a_project_may_add_tasks() {
      $this->signIn();

      $project = factory('App\Project')->create();

      $this->post($project->path() . '/tasks', ['body' => 'Test task'])
         ->assertStatus(403);

      $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
   }

   /** @test */
   public function only_the_owner_of_a_project_may_update_a_task() {
      $this->signIn();

      $project = ProjectFactory::withTasks(1)->create();

      $this->patch($project->tasks->first()->path(), ['body' => 'changed'])
         ->assertStatus(403);

      $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
   }

   /** @test */
   public function a_project_can_have_tasks() {

      $project = ProjectFactory::withTasks(1)->create();

      $this->actingAs($project->owner)
         ->post($project->path() . '/tasks', ['body' => 'Test task']);

      $this->get($project->path())
         ->assertSee('Test task');
   }

   /** @test */
   public function a_task_can_be_updated() {
      
      $project = ProjectFactory::withTasks(1)->create();

      $this->actingAs($project->owner)
         ->patch($project->tasks->first()->path(), $attributes = [
         'body' => 'changed',
         'completed' => true
      ]);

      $this->assertDatabaseHas('tasks', $attributes);
   }

   /** @test */
   public function a_task_can_be_completed() {
      $project = ProjectFactory::withTasks(1)->create();

      $this->actingAs($project->owner)
         ->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
         ]);

      $this->assertTrue($project->fresh()->tasks->first()->completed);
   }

   /** @test */
   public function a_task_can_be_marked_as_incompleted() {
      $project = ProjectFactory::withTasks(1)->create();

      $this->actingAs($project->owner)
         ->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
         ]);

      $this->assertTrue($project->fresh()->tasks->first()->completed);

      $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => false
         ]);

      $this->assertDatabaseHas('tasks', [
         'body' => 'changed',
         'completed' => false
      ]);
   }

   /** @test */
   public function a_task_requires_a_body() {
      
      $project = ProjectFactory::create();

      $attributes = factory('App\Task')->raw(['body' => '']);

      $this->actingAs($project->owner)
         ->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
   }
}
