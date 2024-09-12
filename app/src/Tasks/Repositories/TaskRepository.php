<?php
namespace App\src\Tasks\Repositories;

use App\Models\Task;
use App\src\Tasks\Contracts\ITaskRepository;
use App\src\Tasks\Dtos\CreateTaskDto;
use App\src\Tasks\Dtos\UpdateTaskDto;
use App\src\Tasks\Entities\TaskEntity;

class TaskRepository implements ITaskRepository
{

    public function getTask($id)
    {
        $task = $this->task($id);

        return new TaskEntity
        (
            $task->id,
            $task->name,
            $task->state,
            $task->priority,
            $task->project_id,
            $task->created_at,
            $task->updated_at
        );
    }

    public function getTasksByProjectId($id)
    {
        $tasks = Task::where('project_id', $id)->get();
       
        return $tasks->toArray();
    }

    public function save(CreateTaskDto $dto)
    {
        Task::create([
           'name' => $dto->getName(),
           'project_id' => $dto->getProjectId() 
        ]);
    }

    public function update(UpdateTaskDto $dto)
    {
        $task = $this->task($dto->getId());
        $task->update([
            'name' => $dto->getName(),
            'state' => $dto->getState(),
            'priority' => $dto->getPriority()
        ]);
    }

    public function delete($id)
    {
        $task = $this->task($id);
        $task->delete();
    }

    private function task($id)
    {
        return Task::find($id);
    }
}