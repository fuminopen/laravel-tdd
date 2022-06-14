<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Request $request)
    {
        (new Project())->addTask($request->body);
    }
}
