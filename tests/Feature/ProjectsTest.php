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
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /**
     * @test
     */
    public function test_a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

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
