<?php

namespace BenConstable\Localize\Determiners;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * This determiner chains together other determiners and pulls the locale from
 * the first one that provides a match.
 */
class Stack extends Determiner
{
    /**
     * Constructor.
     *
     * @param  Collection  $determiners
     * @return  void
     */
    public function __construct(private Collection $determiners)
    {}

    /**
     * Determine the locale from the underlying determiner stack.
     *
     * @param  Request  $request
     * @return string
     */
    public function determineLocale(Request $request): string
    {
        $locale = $this->determiners
            ->map(function ($determiner) use ($request) {
                return $determiner->determineLocale($request);
            })
            ->filter()
            ->first();

        return $locale ?: $this->fallback;
    }

    /**
     * Get the underlying determiner stack.
     *
     * @return  Collection
     */
    public function getDeterminers()
    {
        return $this->determiners;
    }
}
