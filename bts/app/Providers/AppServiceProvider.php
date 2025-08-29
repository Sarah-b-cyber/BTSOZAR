<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Groupes;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('chat.*', function ($view) {
            $users = User::where('id', '!=', Auth::id())->get();
            $groups = Groupes::all();
            $view->with(compact('users', 'groups'));
        });
    }
}
