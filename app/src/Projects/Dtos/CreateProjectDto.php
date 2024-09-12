<?php
namespace App\src\Projects\Dtos;

class CreateProjectDto
{
    private string $name;
    private string $description;    
    
    public function __construct($name, $description) {
        $this->name = $name;
        $this->description = $description;        
    }

    public function getName() { return $this->name; }
    
    public function getDescription() { return $this->description; }
    
}