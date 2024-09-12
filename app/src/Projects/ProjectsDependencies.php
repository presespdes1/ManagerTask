<?php
namespace app\src\Projects;

use App\src\Projects\Contracts\IProjectRepository;
use App\src\Projects\Repositories\ProjectRepository;
use Illuminate\Support\ServiceProvider;

class ProjectsDependencies extends ServiceProvider
{
    /**
     * Register any customer application services
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IProjectRepository::class, ProjectRepository::class);
    }

    /**
     * Bootstrap any application services here
     * @return void
     */
    public function boot():void
    {
        
    }
}