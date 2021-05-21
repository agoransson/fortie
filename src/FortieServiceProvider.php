<?php

namespace Wetcat\Fortie;

/*

   Copyright The Fortie authors

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

*/

use Config;
use Illuminate\Support\ServiceProvider;

class FortieServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $configPath = __DIR__.'/config/config.php';

    protected $commands = [
        Commands\ActivateCommand::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }

        $this->publishes([
            $this->$configPath => config_path('fortie.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->$configPath, 'fortie');

        $this->registerFortie();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Creates a new Fortie object.
     *
     * @return void
     */
    protected function registerFortie()
    {
        $this->app->singleton(Fortie::class, function ($app) {
            $access_token = Config::get('fortie.default.access_token', Config::get('fortie::default.access_token'));
            $client_secret = Config::get('fortie.default.client_secret', Config::get('fortie::default.client_secret'));
            $content_type = Config::get('fortie.default.content_type', Config::get('fortie::default.content_type'));
            $accepts = Config::get('fortie.default.accepts', Config::get('fortie::default.accepts'));
            $endpoint = Config::get('fortie.default.endpoint', Config::get('fortie::default.endpoint'));
            $transport = Config::get('fortie.default.transport', Config::get('fortie::default.transport'));

            return new Fortie(
                $endpoint,
                $access_token,
                $client_secret,
                $content_type,
                $accepts,
                $transport
            );
        });
    }
}
