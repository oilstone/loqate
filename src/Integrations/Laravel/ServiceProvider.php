<?php

/** @noinspection PhpUndefinedFunctionInspection,PhpUnusedParameterInspection */

namespace Oilstone\Loqate\Integrations\Laravel;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Oilstone\Loqate\Loqate;

/**
 * Class ServiceProvider
 * @package Oilstone\Loqate\Integrations\Laravel
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../../../config/loqate.php';

        $this->publishes([$configPath => $this->getConfigPath()], 'config');
    }

    /**
     * Get the config path
     *
     * @return string
     */
    protected function getConfigPath()
    {
        return config_path('loqate.php');
    }

    /**
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../../../config/loqate.php';

        $this->mergeConfigFrom($configPath, 'loqate');

        $this->app->bind('loqate', function ($app) {
            return new Loqate(new Client([
                'verify' => !$this->app->environment('local'),
            ]), config('loqate'));
        });
    }

    /**
     * Publish the config file
     *
     * @param string $configPath
     */
    protected function publishConfig($configPath)
    {
        $this->publishes([$configPath => config_path('loqate.php')], 'config');
    }
}
