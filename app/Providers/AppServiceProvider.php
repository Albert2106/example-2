<?php

namespace App\Providers;

use App\Contracts\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;
use Livewire\Blaze\Blaze;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    public function boot(): void
    {
        Blaze::optimize()->in(resource_path('views/components'));
    }
}
