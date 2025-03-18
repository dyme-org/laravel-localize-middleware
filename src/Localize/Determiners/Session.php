<?php

namespace BenConstable\Localize\Determiners;

use Illuminate\Http\Request;

/**
 * This locale determiner fetches the locale from the session.
 */
class Session extends Determiner
{
    /**
     * Constructor.
     *
     * @param  string  $sessionKey  Name of the session key that holds the locale
     * @return  void
     */
    public function __construct(private string $sessionKey)
    {}

    /**
     * Determine the locale from the session.
     *
     * @param  Request  $request
     * @return  string
     */
    public function determineLocale(Request $request): string
    {
        return $request->session()->get($this->sessionKey, $this->fallback);
    }
}
