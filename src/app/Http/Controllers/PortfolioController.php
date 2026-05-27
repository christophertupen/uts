<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'profile' => Profile::latest()->first(),
            'projects' => Project::latest()->get(),
            'skills' => Skill::orderByDesc('level')->get(),
        ]);
    }

    public function show(Project $project)
    {
        return view('project-detail', compact('project'));
    }
}