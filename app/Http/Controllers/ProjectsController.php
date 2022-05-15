<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
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
     * display records on get request
     */
    public function index(Request $request)
    {
        $projects = $this->project->all();

        return view('projects', ['projects' => $projects]);
    }

    /**
     * create records on post request
     */
    public function store(Request $request)
    {
        $this->project->create(
            $request->only(['title', 'description'])
        );
    }
}
