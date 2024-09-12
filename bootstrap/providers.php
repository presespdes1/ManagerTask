<?php

use app\src\Projects\ProjectsServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\src\Projects\ProjectsDependencies::class,
    App\src\User\UserDependencies::class,
    App\src\Tasks\TaskDependencies::class,
];
