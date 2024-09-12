<?php

namespace App\Http\Controllers;

use App\Priority;
use App\src\Tasks\Dtos\CreateTaskDto;
use App\src\Tasks\Dtos\UpdateTaskDto;
use App\src\Tasks\Services\TaskService;
use App\src\User\Services\UserService;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TaskController extends Controller
{
    private TaskService $taskService;
    private UserService $userService;

    public function __construct(TaskService $taskService, UserService $userService) {
        $this->taskService = $taskService;
        $this->userService = $userService;
    }

    public function tasksByProjectId($id)
    {
        $data = $this->userService->toProjectResponse();
    
        $p_selected = array_filter($data['projects'], 
                        function($p) use ($id) {return ($p['id'] == $id) ? $p : null;
                    });
                          
        return Inertia::render('Projects', 
            [
                'projects' =>  $data['projects'], 
                'tasks' => $data['tasks'],
                'project_selected' => array_values($p_selected)[0]
            ]);        
    }

    public function show($id)
    {
        dd($id);
    }

    public function delete($id)
    {
        $this->taskService->deleteTask($id);

        return Redirect::route('projects');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'project_id' => 'required'
       ]);
        $taskDto = new CreateTaskDto
        (
            $request->name,
            $request->project_id
        );

        $this->taskService->saveTask($taskDto);

        return Redirect::route('projects');
    }

    public function create($id)
    {     
        return Inertia::render("Project/CreateTaskForm", ['project_id' => $id]);     
    }

    public function updatePage($id)
    {
        $stateCases = [];
        $priorityCases = [];
        foreach(State::cases() as $case)
        {
            $stateCases[] = ['name' => $case->name, 'value' => $case->value];
        }
        foreach(Priority::cases() as $case)
        {
            $priorityCases[] = ['name' => $case->name, 'value' => $case->value];
        }

        $taskEntity = $this->taskService->getTaskById($id);       
      
        return Inertia::render("Project/UpdateTaskForm", 
        [
            'task' => $taskEntity->toUpdateForm(),
            'stateCases' => $stateCases,
            'priorityCases' => $priorityCases
        ]); 
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'id' => 'required'
       ]);
        $updateDto = new UpdateTaskDto(
            $request->id,
            $request->name,
            $request->state,
            $request->priority
        );
        $this->taskService->updateTask($updateDto);

        return Redirect::route('projects');
    }
}
