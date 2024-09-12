<?php
namespace App\src\User\Entities;

class UserEntity
{
    private $id;
    private $name;
    private $email;
    private $projects;
    private $tasks;

    public function __construct(
        $id,
        $name,
        $email,
        $projects,
        $tasks
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->projects = $projects;
        $this->tasks = $tasks;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getProjects() { return $this->projects; }
    public function getTasks() { return $this->tasks; }

    public function setId($value) { $this->id = $value; }
    public function setName($value) { $this->name = $value; }
    public function setEmail($value) { $this->email = $value; }
    public function setProjects($value) { $this->projects = $value; }
    public function setTasks($value) { $this->tasks = $value; }

    public function toProjectResponse()
    {
        return [
            'projects' => count($this->projects) > 0 ? $this->projects : null,
            'tasks' => count($this->tasks) > 0 ? $this->tasks : null
        ];
    }
}