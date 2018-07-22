<?php

namespace App\Providers;

use View;
use Event;
use Utils;
use Parsedown;
use App\Events;
use ReflectionException;
use Illuminate\Support\ServiceProvider;
use App\Exceptions\PrettyPageException;
use App\Services\Repositories\UserRepository;
use App\Services\Repositories\OptionRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Replace HTTP_HOST with site url setted in options to prevent CDN source problems
        if (! option('auto_detect_asset_url')) {
            $rootUrl = option('site_url');

            if ($this->app['url']->isValidUrl($rootUrl)) {
                $this->app['url']->forceRootUrl($rootUrl);
            }
        }

        if (option('force_ssl') || Utils::isRequestSecure()) {
            $this->app['url']->forceSchema('https');
        }

        View::addExtension('tpl', 'blade');

        Event::listen(Events\RenderingHeader::class, function($event) {
            // Provide some application information for javascript
            $blessing = array_merge(array_except(config('app'), ['key', 'providers', 'aliases', 'cipher', 'log', 'url']), [
                'base_url' => url('/'),
                'site_name' => option_localized('site_name')
            ]);

            $event->addContent('<script>var blessing = '.json_encode($blessing).';</script>');
        });

        try {
            $this->app->make('cipher');
        } catch (ReflectionException $e) {
            throw new PrettyPageException(trans('errors.cipher.unsupported', ['cipher' => config('secure.cipher')]));
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cipher', 'App\Services\Cipher\\'.config('secure.cipher'));
        $this->app->singleton('parsedown', Parsedown::class);
        $this->app->singleton('users', UserRepository::class);
        $this->app->singleton('options', OptionRepository::class);
    }
}
