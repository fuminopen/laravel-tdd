<?php

namespace Tests\Unit;

use App\Models\Project;
use Tests\TestCase;

class ProjectTest extends TestCase
{
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
}
