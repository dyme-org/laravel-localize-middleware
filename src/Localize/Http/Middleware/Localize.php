<?php

namespace BenConstable\Localize\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use BenConstable\Localize\DeterminerManager;
use Illuminate\Http\Request;

/**
 * This middleware localizes the application using the configured
 * locale determiner.
 */
class Localize
{
    /**
     * Constructor.
     *
     * @param  Application  $app
     * @param  DeterminerManager  $determinerManager
     * @return  void
     */
    public function __construct(
        private Application $app,
        private DeterminerManager $determinerManager
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return  mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = auth()->user()?->locale ?? $this->determinerManager->determineLocale($request);

        $this->app->setLocale(locale_lookup(
            $this->app['config']['localize-middleware']['available_locales'] ?? [],
            $locale,
            false,
            $this->app['config']['app']['fallback_locale']
        ));

        return $next($request);
    }
}
