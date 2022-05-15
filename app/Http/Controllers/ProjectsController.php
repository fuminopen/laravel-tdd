<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
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
