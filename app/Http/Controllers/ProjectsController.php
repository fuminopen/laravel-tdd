<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectsRequest;
use App\Models\Project;
use App\Services\ProjectsService;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * display records on get request
     */
    public function index(Request $request)
    {
        $projects = app()->make(ProjectsService::class)
            ->getAll();

        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * create records on post request
     */
    public function store(CreateProjectsRequest $request)
    {
        auth()->user()->projects()->create();

        return redirect('/projects');
    }

    /**
     * show a specific project
     */
    public function show(Project $project)
    {
        return view(
            'projects.show',
            [
                'project' => $project,
            ]
        );
    }
}
