<?php
namespace App\src\Projects\Repositories;

use App\Models\Project;
use App\src\Projects\Contracts\IProjectRepository;
use App\src\Projects\Dtos\CreateProjectDto;
use App\src\Projects\Dtos\UpdateProjectDto;
use App\src\Projects\Entities\ProjectEntity;
use Nette\NotImplementedException;

class ProjectRepository implements IProjectRepository
{
    
    public function GetById(int $id)
    {
        $projectModel = Project::find($id);
        return new ProjectEntity(
            $projectModel->id,
            $projectModel->name,
            $projectModel->description,
            $projectModel->archived,
            $projectModel->user_id,
            $projectModel->createdAt,
            $projectModel->updatedAt
        );
    }

    public function Save($userId, CreateProjectDto $createDto)
    {
        Project::create([
            'name' => $createDto->getName(),
            'description' => $createDto->getDescription(),
            'user_id' => $userId
        ]);
    }

    public function Update(int $id, UpdateProjectDto $updateDto)
    {
        $projectModel = Project::find($id);
        $projectModel->update([
            'name' => $updateDto->getName(),
            'description' => $updateDto->getDescription(),
            'archived' => $updateDto->isArchived()
        ]);
    }

    public function Delete(int $id)
    {
         Project::find($id)->delete();        
    }

    public function Exists(int $id)
    {
        return Project::findOrFail($id) != null ? true : false;
    }

}