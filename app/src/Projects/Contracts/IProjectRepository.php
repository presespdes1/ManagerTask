<?php
namespace App\src\Projects\Contracts;

use App\src\Projects\Dtos\CreateProjectDto;
use App\src\Projects\Dtos\UpdateProjectDto;

interface IProjectRepository
{
   
    public function GetById(int $id);

    public function Save(int $userId, CreateProjectDto $createDto);

    public function Update(int $id, UpdateProjectDto $updateDto);

    public function Delete(int $id); 
    
    public function Exists(int $id);
    
}