<?php

namespace BenConstable\Localize\Determiners;

use Illuminate\Http\Request;

/**
 * This locale determiner fetches the locale from a cookie.
 */
class Cookie extends Determiner
{
    /**
     * Constructor.
     *
     * @param  string  $cookieName  Name of the cookie that holds the locale
     * @return  void
     */
    public function __construct(private string $cookieName)
    {}

    /**
     * Determine the locale from a cookie.
     *
     * @param  Request  $request
     * @return  string
     */
    public function determineLocale(Request $request): string
    {
        return $request->cookie($this->cookieName, $this->fallback);
    }
}
