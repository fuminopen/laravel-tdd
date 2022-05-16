<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        app()->make(ProjectsService::class)
            ->create(
                $request->title,
                $request->description
            );
    }
}
