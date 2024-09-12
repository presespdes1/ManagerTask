<?php
namespace App\src\Projects\Dtos;

class UpdateProjectDto
{
    private  $name;
    private  $description;
    private  $archived;
    
    public function __construct($name, $description, $archived) {
        $this->name = $name;
        $this->description = $description;
        $this->archived = $archived;
    }

    public function getName() { return $this->name; }
    
    public function getDescription() { return $this->description; }

    public function isArchived() { return $this->archived; }
}