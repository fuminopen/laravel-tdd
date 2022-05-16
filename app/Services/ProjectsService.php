<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectsService
{
    /**
     * @var Project
     */
    protected Project $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * get all projects
     */
    public function getAll(): Collection
    {
        return $this->project->all();
    }

    /**
     * create a record
     */
    public function create(string $title, string $description): ?Project
    {
        return $this->project->create(
            [
                'title' => $title,
                'description' => $description,
            ]
        );
    }
}
