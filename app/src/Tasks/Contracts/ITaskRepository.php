<?php
namespace App\src\Tasks\Contracts;

use App\src\Tasks\Dtos\CreateTaskDto;
use App\src\Tasks\Dtos\UpdateTaskDto;

interface ITaskRepository
{
    public function getTask($id);

    public function getTasksByProjectId($id);

    public function save(CreateTaskDto $createDto);

    public function update(UpdateTaskDto $updateDto);

    public function delete($id);
}