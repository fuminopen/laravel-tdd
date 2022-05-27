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
        $projects = auth()->user()->projects;

        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * create records on post request
     */
    public function store(CreateProjectsRequest $request)
    {
        auth()->user()->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/projects');
    }

    /**
     * show a specific project
     */
    public function show(Project $project)
    {
        if (auth()->user()->id !== (int) $project->owner_id) {
            abort(403);
        }

        return view(
            'projects.show',
            [
                'project' => $project,
            ]
        );
    }
}
