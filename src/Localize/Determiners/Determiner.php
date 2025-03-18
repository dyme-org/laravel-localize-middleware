<?php

namespace BenConstable\Localize\Determiners;

/**
 * Base determiner class that provides some common methods.
 */
abstract class Determiner implements DeterminerInterface
{
    /**
     * The fallback locale to use if determiner can't determine a locale.
     *
     * @var  string|null
     */
    protected ?string $fallback = null;

    /**
     * {@inheritdoc}
     */
    public function setFallback(string $locale): DeterminerInterface|static
    {
        $this->fallback = $locale;

        return $this;
    }
}
