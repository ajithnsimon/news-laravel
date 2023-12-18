<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\User\Repositories\UserRepositoryInterface;
use App\Modules\User\Repositories\UserRepository;
use App\Modules\UserPreference\Repositories\UserPreferenceRepositoryInterface;
use App\Modules\UserPreference\Repositories\UserPreferenceRepository;
use App\Modules\Article\Repositories\ArticleRepositoryInterface;
use App\Modules\Article\Repositories\ArticleRepository;
use App\Modules\Author\Repositories\AuthorRepositoryInterface;
use App\Modules\Author\Repositories\AuthorRepository;
use App\Modules\Category\Repositories\CategoryRepositoryInterface;
use App\Modules\Category\Repositories\CategoryRepository;
use App\Modules\Source\Repositories\SourceRepositoryInterface;
use App\Modules\Source\Repositories\SourceRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $repositories = [
        UserRepositoryInterface::class => UserRepository::class,
        UserPreferenceRepositoryInterface::class => UserPreferenceRepository::class,
        ArticleRepositoryInterface::class => ArticleRepository::class,
        AuthorRepositoryInterface::class => AuthorRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        SourceRepositoryInterface::class => SourceRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, function ($app) use ($repository) {
                return new $repository;
            });
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}