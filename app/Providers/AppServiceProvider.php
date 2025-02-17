<?php

namespace App\Providers;

use App\Task;
use App\Project;
use App\Observers\TaskObserver;
use App\Observers\ProjectObserver;
use Illuminate\Database\Schema\Builder; 
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191); // Update defaultStringLength
        //Project::observe(ProjectObserver::class);
        //Task::observe(TaskObserver::class);
    }
}
