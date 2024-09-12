<?php
namespace App\src\Tasks\Dtos;

class UpdateTaskDto
{
    private $id;
    private $name;
    private $state;
    private $priority;
    
    public function __construct($id, $name, $state, $priority) {
        $this->id = $id;
        $this->name = $name;
        $this->state = $state;
        $this->priority = $priority;
    }

    public function getId() { return $this->id; }

    public function getName() { return $this->name; }

    public function getState() { return $this->state; }

    public function getPriority() { return $this->priority; } 
}