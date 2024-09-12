<?php
namespace App\src\User\Repositories;

use App\Models\User;
use App\src\User\Contracts\IUserRepository;
use App\src\User\Entities\UserEntity;
use Illuminate\Support\Facades\Auth;

class UserRepository implements IUserRepository
{
    public function getAuthenticated()
    {    
        $user = User::find(Auth::user()->id);  
        
        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            $user->projects->toArray(),
            $user->projectTasks->toArray()
        );

    }

}