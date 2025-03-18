<?php

namespace BenConstable\Localize\Determiners;

use Illuminate\Http\Request;

/**
 * This locale determiner fetches the locale from a request parameter.
 */
class Parameter extends Determiner
{
    /**
     * Constructor.
     *
     * @param  string  $requestParam  Name of the request parameter that holds the locale
     * @return  void
     */
    public function __construct(private string $requestParam)
    {}

    /**
     * Determine the locale from the request parameters.
     *
     * @param  Request  $request
     * @return  string
     */
    public function determineLocale(Request $request): string
    {
        return $request->input($this->requestParam, $this->fallback);
    }
}
