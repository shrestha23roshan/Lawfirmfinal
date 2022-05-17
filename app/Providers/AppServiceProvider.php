<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryEloquent;
use Modules\Configuration\Repositories\User\UserRepository;
use Modules\Configuration\Repositories\User\UserRepositoryEloquent;
use Modules\Configuration\Repositories\Role\RoleRepository;
use Modules\Configuration\Repositories\Role\RoleRepositoryEloquent;
use Modules\Configuration\Repositories\Module\ModuleRepository;
use Modules\Configuration\Repositories\Module\ModuleRepositoryEloquent;
use Modules\Services\Repositories\Services\ServicesRepository;
use Modules\Services\Repositories\Services\ServicesRepositoryEloquent;
use Modules\News\Repositories\News\NewsRepository;
use Modules\News\Repositories\News\NewsRepositoryEloquent;
use Modules\Resources\Repositories\Resource\ResourceRepository;
use Modules\Resources\Repositories\Resource\ResourceRepositoryEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            BaseRepository::class,
            BaseRepositoryEloquent::class
        );
        $this->app->singleton(
            UserRepository::class,
            UserRepositoryEloquent::class
        );
        $this->app->singleton(
            RoleRepository::class,
            RoleRepositoryEloquent::class
        );
        $this->app->singleton(
            ModuleRepository::class,
            ModuleRepositoryEloquent::class
        );
        $this->app->singleton(
            ServicesRepository::class,
            ServicesRepositoryEloquent::class
        );
        $this->app->singleton(
            NewsRepository::class,
            NewsRepositoryEloquent::class
        );
        $this->app->singleton(
            ResourceRepository::class,
            ResourceRepositoryEloquent::class
        );
        
    }
}
