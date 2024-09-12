<?php
namespace App\src\Tasks;

use App\src\Tasks\Contracts\ITaskRepository;
use App\src\Tasks\Repositories\TaskRepository;
use Carbon\Laravel\ServiceProvider;

class TaskDependencies extends ServiceProvider
{
    /**
       * Register any customer application services
       * @return void
       */
      public function register()
      {
          $this->app->singleton(ITaskRepository::class, TaskRepository::class);
      }
  
      /**
       * Bootstrap any application services here
       * @return void
       */
      public function boot():void
      {
          
      }
}