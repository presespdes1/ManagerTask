<?php
namespace App\src\Projects\Services;

use App\src\Projects\Contracts\IProjectRepository;
use App\src\Projects\Dtos\CreateProjectDto;
use App\src\Projects\Dtos\UpdateProjectDto;
use App\src\Projects\Entities\ProjectEntity;
use App\src\User\Services\UserService;

class ProjectService
{
    private IProjectRepository $projectRepo;
    private UserService $userService;

    public function __construct(IProjectRepository $projectRepo, UserService $userService) {
        $this->projectRepo = $projectRepo;
        $this->userService = $userService;
    }

    public function storeProject(CreateProjectDto $createDto)
    {
        $userId = $this->userService->getUserAuthenticatedId();
       
        $duplicated = $this->userService->isDuplicatedOnCreate($createDto->getName());
        if($duplicated)
        {
           dd("Duplicado");
        }
        $this->projectRepo->Save($userId, $createDto);
    }

    public function updateProject($projectId, UpdateProjectDto $updateDto)
    {
        //Verificar si existe el proyecto
        $exist = $this->projectRepo->Exists($projectId);
        if(!$exist)
        {
            dd("El proyecto no existe");
        }
        //Si no hay proyectos con el nombre duplicado
        $duplicated = $this->userService->isDuplicatedOnUpdate($updateDto->getName(), $projectId);
        if($duplicated)
        {
            dd("Duplicado");
        }
        
        $this->projectRepo->Update($projectId, $updateDto);
    }

    public function getProject($projectId)
    {
        if(!$this->projectRepo->Exists($projectId))
        {
            return null;
        }
        $project = $this->projectRepo->GetById($projectId);
        return $project->toResponse();
    }

    public function deleteProject($projectId)
    {
        if(!$this->projectRepo->Exists($projectId))
        {
            return null;
        }
        
        $this->projectRepo->Delete($projectId);
    }

}