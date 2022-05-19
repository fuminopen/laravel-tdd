<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectsRequest;
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

        return view('projects', ['projects' => $projects]);
    }

    /**
     * create records on post request
     */
    public function store(CreateProjectsRequest $request)
    {
        app()->make(ProjectsService::class)
            ->create(
                $request->title,
                $request->description
            );

        return redirect('/projects');
    }

    /**
     * show a specific project
     */
    public function show(Request $request)
    {
        return view('projects.show');
    }
}
