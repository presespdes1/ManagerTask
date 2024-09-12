<?php
namespace App\src\Tasks\Dtos;

class CreateTaskDto
{
    private $name;
    private $project_id;

    public function __construct($name, $project_id) {
        $this->name = $name;
        $this->project_id = $project_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getProjectId()
    {
        return $this->project_id;
    }
}