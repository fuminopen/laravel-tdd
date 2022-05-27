<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->project = new Project();
    }

    /**
     * @test
     */
    public function test_project_has_a_path()
    {
        $project = $this->project->factory()->make();

        $this->assertSame('/projects/' . $project->id, $project->path());
    }

    /**
     * @test
     */
    public function test_it_has_an_owner()
    {
        $project = $this->project->factory()->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }
}
