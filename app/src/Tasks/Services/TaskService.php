<?php
namespace App\src\Tasks\Services;

use App\src\Tasks\Contracts\ITaskRepository;
use App\src\Tasks\Dtos\CreateTaskDto;
use App\src\Tasks\Dtos\UpdateTaskDto;

class TaskService
{
    private ITaskRepository $taskRepo;

    public function __construct(ITaskRepository $taskRepo) {
        $this->taskRepo = $taskRepo;
    }

    public function getAllTasksByProjectId($id)
    {
        return $this->taskRepo->getTasksByProjectId($id);;
    }

    public function saveTask(CreateTaskDto $createDto)
    {
        $this->taskRepo->save($createDto);
    }

    public function updateTask(UpdateTaskDto $updateDto)
    {
        $this->taskRepo->update($updateDto);
    }

    public function getTaskById($taskId)
    {
        return $this->taskRepo->getTask($taskId);
    }

    public function deleteTask($id)
    {
        $this->taskRepo->delete($id);
    }
}