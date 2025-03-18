<?php

namespace BenConstable\Localize\Determiners;

use Illuminate\Http\Request;

/**
 * A determiner is used to fetch the current locale using information
 * from the request.
 */
interface DeterminerInterface
{
    /**
     * Use the given request to determine what the application locale should be.
     *
     * @param  Request  $request
     * @return  string  Locale name (en, es etc)
     */
    public function determineLocale(Request $request): string;

    /**
     * Set the fallback locale for this determiner.
     *
     * @param  string  $locale
     * @return  DeterminerInterface
     */
    public function setFallback(string $locale): DeterminerInterface;
}
