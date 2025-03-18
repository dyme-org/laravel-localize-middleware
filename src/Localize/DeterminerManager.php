<?php

namespace BenConstable\Localize;

use BenConstable\Localize\Determiners\Cookie;
use BenConstable\Localize\Determiners\Header;
use BenConstable\Localize\Determiners\Host;
use BenConstable\Localize\Determiners\Parameter;
use BenConstable\Localize\Determiners\Session;
use BenConstable\Localize\Determiners\Stack;
use Illuminate\Http\Request;
use Illuminate\Support\Manager;
use Illuminate\Support\Collection;

/**
 * Manager class for the different locale determiners.
 * @method string determineLocale(Request  $request)
 */
class DeterminerManager extends Manager
{
    /**
     * Get a cookie determiner instance.
     *
     * @return  Cookie
     */
    protected function createCookieDriver(): Cookie
    {
        $determiner = new Cookie(
            $this->container['config']['localize-middleware']['cookie']
        );

        $determiner->setFallback($this->container['config']['app']['fallback_locale']);

        return $determiner;
    }

    /**
     * Get a host determiner instance.
     *
     * @return  Host
     */
    protected function createHostDriver(): Host
    {
        $determiner = new Host(
            new Collection($this->container['config']['localize-middleware']['hosts'])
        );

        $determiner->setFallback($this->container['config']['app']['fallback_locale']);

        return $determiner;
    }

    /**
     * Get a parameter determiner instance.
     *
     * @return  Parameter
     */
    protected function createParameterDriver(): Parameter
    {
        $determiner = new Parameter(
            $this->container['config']['localize-middleware']['parameter']
        );

        $determiner->setFallback($this->container['config']['app']['fallback_locale']);

        return $determiner;
    }

    /**
     * Get a header determiner instance.
     *
     * @return  Header
     */
    protected function createHeaderDriver(): Header
    {
        $determiner = new Header(
            $this->container['config']['localize-middleware']['header']
        );

        $determiner->setFallback($this->container['config']['app']['fallback_locale']);

        return $determiner;
    }

    /**
     * Get a session determiner instance.
     *
     * @return  Session
     */
    protected function createSessionDriver(): Session
    {
        $determiner = new Session(
            $this->container['config']['localize-middleware']['session']
        );

        $determiner->setFallback($this->container['config']['app']['fallback_locale']);

        return $determiner;
    }

    /**
     * Get a stack determiner instance.
     *
     * @return  Stack
     */
    protected function createStackDriver(): Stack
    {
        $determiners = (new Collection((array) $this->container['config']['localize-middleware']['driver']))
            ->filter(function ($driver) {
                return $driver !== 'stack';
            })
            ->map(function ($driver) {
                return $this->driver($driver)->setFallback(null);
            });

        return (new Stack($determiners))
            ->setFallback($this->container['config']['app']['fallback_locale']);
    }

    /**
     * Get the default localize driver name.
     *
     * @return  string
     */
    public function getDefaultDriver(): string
    {
        $driver = $this->container['config']['localize-middleware']['driver'];

        return is_array($driver) ? 'stack' : $driver;
    }
}
