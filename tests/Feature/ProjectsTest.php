<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class ProjectsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @var \App\Models\Project
     */
    private Project $project;

    public function setUp(): void
    {
        parent::setUp();

        $this->project = new Project();
    }

    /**
     * @test
     */
    public function test_a_user_can_create_a_project()
    {
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /**
     * @test
     */
    public function test_a_user_can_view_a_project()
    {
        $project = $this->project->factory()->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /**
     * @test
     */
    public function test_title_needs_validation()
    {
        $attributes = $this->project->factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function test_description_needs_validation()
    {
        $attributes = $this->project->factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function test_a_project_needs_an_owner()
    {
        $attributes = $this->project->factory()->raw(['owner_id' => null]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('owner_id');
    }

    /**
     * @test
     */
    public function test_title_must_be_string()
    {
        $attributes = $this->project->factory()->raw(['title' => ['this is type array']]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function test_description_must_be_string()
    {
        $attributes = $this->project->factory()->raw(['description' => ['this is type array']]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
