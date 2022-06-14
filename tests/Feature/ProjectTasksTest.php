<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_have_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create([
            'owner_id' => auth()->id(),
        ]);

        $this->post($project->path() . '/tasks', ['body' => 'Lorem ipsum']);

        $this->get($project->path())->assertSee('Test Task');
    }
}
