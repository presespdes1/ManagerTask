<?php
namespace App\src\User;

use App\src\User\Contracts\IUserRepository;
use App\src\User\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserDependencies extends ServiceProvider
{
     /**
     * Register any customer application services
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services here
     * @return void
     */
    public function boot():void
    {
        
    }
}