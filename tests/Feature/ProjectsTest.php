<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
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
    public function test_only_authenticated_user_can_create_a_project()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw([
            'owner_id' => auth()->id(),
        ]);

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /**
     * @test
     */
    public function test_user_can_view_a_project()
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
        $this->actingAs(User::factory()->create());

        $attributes = $this->project->factory()->raw([
            'title' => '',
            'owner_id' => auth()->id(),
        ]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function test_description_needs_validation()
    {
        $this->actingAs(User::factory()->create());

        $attributes = $this->project->factory()->raw([
            'description' => '',
            'owner_id' => auth()->id(),
        ]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function test_a_project_requires_an_owner()
    {
        $this->actingAs(User::factory()->create());

        $attributes = $this->project->factory()->raw([
            'owner_id' => null,
        ]);

        $this->post('/projects', $attributes)->assertRedirect('/projects');
    }

    /**
     * @test
     */
    public function test_title_must_be_string()
    {
        $this->actingAs(User::factory()->create());

        $attributes = $this->project->factory()->raw([
            'title' => ['this is type array'],
            'owner_id' => auth()->id(),
        ]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function test_description_must_be_string()
    {
        $this->actingAs(User::factory()->create());

        $attributes = $this->project->factory()->raw([
            'description' => ['this is type array'],
            'owner_id' => auth()->id(),
        ]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
