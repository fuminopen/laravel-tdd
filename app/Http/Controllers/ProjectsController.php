<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * display records on get request
     */
    public function index(Request $request)
    {
        $projects = Project::all();

        return view('projects', ['projects' => $projects]);
    }

    /**
     * create records on post request
     */
    public function store(Request $request)
    {
        Project::create(
            $request->only(['title', 'description'])
        );
    }
}
