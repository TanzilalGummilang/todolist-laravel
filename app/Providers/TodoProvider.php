<?php

namespace App\Providers;

use App\Services\Interface\TodoServiceInterface;
use App\Services\TodoService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodoProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TodoServiceInterface::class => TodoService::class
    ];

    public function provides()
    {
        return [TodoServiceInterface::class];
    }
    
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
