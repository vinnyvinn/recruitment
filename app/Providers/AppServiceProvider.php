<?php

namespace Boaz\Providers;

use Carbon\Carbon;
use Boaz\Repositories\Activity\ActivityRepository;
use Boaz\Repositories\Activity\EloquentActivity;
use Boaz\Repositories\Country\CountryRepository;
use Boaz\Repositories\Country\EloquentCountry;
use Boaz\Repositories\Permission\EloquentPermission;
use Boaz\Repositories\Permission\PermissionRepository;
use Boaz\Repositories\Role\EloquentRole;
use Boaz\Repositories\Role\RoleRepository;
use Boaz\Repositories\Session\DbSession;
use Boaz\Repositories\Session\SessionRepository;
use Boaz\Repositories\User\EloquentUser;
use Boaz\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        config(['app.name' => settings('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
