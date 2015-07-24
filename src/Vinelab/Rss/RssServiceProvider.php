<?php

namespace Vinelab\Rss;

use Illuminate\Support\ServiceProvider;

class RssServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->register('Vinelab\Http\HttpServiceProvider');

        $this->app->bind('vinelab.rss', function ($app) {
            return new Rss($app->make('Vinelab\Rss\Parsers\XML'),
                            $app->make('Vinelab\Http\Client'));
        });

        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('RSS', 'Vinelab\Rss\Facades\RSS');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
