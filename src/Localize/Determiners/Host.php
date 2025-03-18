<?php

namespace BenConstable\Localize\Determiners;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * This locale determiner fetches the locale from the request host
 * and a pre-defined mapping.
 */
class Host extends Determiner
{
    /**
     * Constructor.
     *
     * @param  Collection  $hostMapping  Locale to host mapping
     * @return  void
     */
    public function __construct(private Collection $hostMapping)
    {}

    /**
     * Determine the locale from the current host.
     *
     * @param  Request  $request
     * @return  string
     */
    public function determineLocale(Request $request): string
    {
        return $this->hostMapping->flip()->get($request->getHost(), $this->fallback);
    }
}
