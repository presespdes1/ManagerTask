<?php

namespace App\Http\Controllers;

use App\src\User\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service) {
        $this->service = $service;
    }

    public function projects()
    {
        $data = $this->service->toProjectResponse();
        
        return Inertia::render('Projects', 
            [
                'projects' =>  $data['projects'], 
                'tasks' => $data['tasks'],
                'project_selected' => $data['projects'] != null ? $data['projects'][0] : null 
            ]);
    }

}
