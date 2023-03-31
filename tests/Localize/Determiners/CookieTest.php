<?php

namespace Localize\BenConstable\Localize\Determiners;

use Mockery;
use PHPUnit\Framework\TestCase;
use BenConstable\Localize\Determiners\Cookie;

class CookieTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    /** @test **/
    public function determine_locale()
    {
        $locale = 'en';

        $request = Mockery::mock('Illuminate\Http\Request');

        $request
            ->shouldReceive('cookie')
            ->with('locale', null)
            ->andReturn($locale);

        $result = (new Cookie('locale'))->determineLocale($request);

        $this->assertEquals($result, $locale);
    }

    /** @test **/
    public function fallback_if_no_locale_found()
    {
        $fallback = 'de';

        $request = Mockery::mock('Illuminate\Http\Request');

        $request
            ->shouldReceive('cookie')
            ->with('locale', $fallback)
            ->andReturn($fallback);

        $result = (new Cookie('locale'))->setFallback($fallback)->determineLocale($request);

        $this->assertEquals($result, $fallback);
    }
}
