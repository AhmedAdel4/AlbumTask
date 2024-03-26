<?php

namespace App\Providers;

use App\Repositories\AlbumRepositoryInterface;
use App\Repositories\ElequentRepository\AlbumRepository;
use App\Repositories\ElequentRepository\ImageRepository;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Support\ServiceProvider;




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
    }
}
