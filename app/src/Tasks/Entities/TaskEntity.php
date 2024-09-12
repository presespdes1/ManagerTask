<?php
namespace App\src\Tasks\Entities;

class TaskEntity
{
    private $id;
    private $name;
    private $state;
    private $priority;
    private $project_id;
    private $createdAt;
    private $updatedAt;

    public function __construct
    (
        $id,
        $name,
        $state,
        $priority,
        $project_id,
        $createdAt,
        $updatedAt
    ) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->state = $state;
        $this->priority = $priority;
        $this->project_id = $project_id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getState() { return $this->state; }
    public function getPriority() { return $this->priority; }
    public function getProjectId() { return $this->project_id; }
    public function getCreatedAt() { return $this->createdAt; }
    public function getUpdatedAt() { return $this->updatedAt; }

    public function setId($value) { $this->id = $value; }
    public function setName($value) { $this->name = $value; }
    public function setState($value) { $this->state = $value; }
    public function setPriority($value) { $this->priority = $value; }
    public function setProjectId($value) { $this->project_id = $value; }
    public function setCreatedAt($value) { $this->createdAt = $value; }
    public function setUpdatedAt($value) { $this->updatedAt = $value; }

    public function toUpdateForm()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'state' => $this->state,
            'priority' => $this->priority
        ];
    }
}