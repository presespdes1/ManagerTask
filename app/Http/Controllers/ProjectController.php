<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\src\Projects\Dtos\CreateProjectDto;
use App\src\Projects\Dtos\UpdateProjectDto;
use App\src\Projects\Services\ProjectService;
use App\src\User\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProjectController extends Controller
{
    private ProjectService $proService;
   
    public function __construct(ProjectService $proService) 
    {
        $this->proService = $proService;       
    }
    
    public function updatePage($id)
    {
        $project = $this->proService->getProject($id);
        return Inertia::render('Project/UpdateProjectForm', ["project" => $project]); 
    }

    public function create()
    {        
        return Inertia::render('Project/CreateProjectForm'); 
    }

    public function store(Request $request)
    {  
        $request->validate([
             'name' => 'required|min:3|max:100',
            'description' => 'nullable|max:255'
        ]);
      
        $createDto = new CreateProjectDto(
            $request->name,
            $request->description !== null ? $request->description : ""
        );
        
        $this->proService->storeProject($createDto);

        return Redirect::route('projects');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
           'description' => 'nullable|max:255'
       ]);
        //Tomar los datos del formulario cuando se cree    
        $updateDto = new UpdateProjectDto(
           $request->name,
           $request->description,
            $request->archived
        );
        $this->proService->updateProject($id, $updateDto);

        return Redirect::route('projects');
    }

    public function show($id)
    {
        $project = $this->proService->getProject($id);
        if($project == null)
        {
            return Redirect::route('projects');
        }
        dd($project);
    }

    public function delete($id)
    {        
        if($this->proService->deleteProject($id) == null)
        {
            return Redirect::route('projects');
        }
        // dd("Eliminado astisfactoriamente");
    }
}
