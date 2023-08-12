<?php

namespace HossamTarek\LaravelPresenter;

use HossamTarek\LaravelPresenter\Console\MakePresenterCommand;
use Illuminate\Support\ServiceProvider;

class LaravelPresenterServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakePresenterCommand::class
            ]);
        }
    }
}