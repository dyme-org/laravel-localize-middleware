<?php

namespace BenConstable\Localize\Determiners;

use Illuminate\Http\Request;

/**
 * This locale determiner fetches the locale from a request header.
 */
class Header extends Determiner
{
    /**
     * Constructor.
     *
     * @param  string  $header  Name of the header that holds the locale
     * @return  void
     */
    public function __construct(private string $header)
    {}

    /**
     * Determine the locale from the request parameters.
     *
     * @param  Request  $request
     * @return  string
     */
    public function determineLocale(Request $request): string
    {
        return $request->header($this->header, $this->fallback);
    }
}
