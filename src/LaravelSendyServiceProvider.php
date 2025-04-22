<?php

namespace Coderflex\LaravelSendy;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Coderflex\LaravelSendy\Commands\LaravelSendyCommand;

class LaravelSendyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-sendy')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_sendy_table')
            ->hasCommand(LaravelSendyCommand::class);
    }
}
