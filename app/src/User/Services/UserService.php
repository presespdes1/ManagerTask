<?php
namespace App\src\User\Services;

use App\src\User\Contracts\IUserRepository;
use Mockery\Matcher\Any;

class UserService
{
    private IUserRepository $userRepo;

    public function __construct(IUserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function getUserAuthenticatedId()
    {
        $userEntity = $this->userRepo->getAuthenticated();
        return $userEntity->getId();
    }

    public function getProjects()
    {
        $userEntity = $this->userRepo->getAuthenticated();
        return $userEntity->getProjects();
    }

    public function toProjectResponse()
    {
        $userEntity = $this->userRepo->getAuthenticated();
        return $userEntity->toProjectResponse();
    }

    public function isDuplicatedOnCreate($projectName)
    {
        $projects = $this->getProjects();       
        return in_array($projectName, array_column((array)$projects, 'name'));
    }

    public function isDuplicatedOnUpdate($projectName, $projectId)
    {
        $projects = $this->getProjects();
        $duplicated = array_filter($projects, function($p) use ($projectName, $projectId){                  
                return ($p['name'] == $projectName && $p['id'] != $projectId);        
        });
        return count($duplicated) > 0 ? true : false;       
    }

   

    
}