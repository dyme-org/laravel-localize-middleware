<?php

namespace Localize\BenConstable\Localize\Determiners;

use Mockery;
use PHPUnit\Framework\TestCase;
use BenConstable\Localize\Determiners\Session;

class SessionTest extends TestCase
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
        $session = Mockery::mock('Illuminate\Session\Store');

        $request
            ->shouldReceive('session')
            ->andReturn($session);

        $session
            ->shouldReceive('get')
            ->with('locale', null)
            ->andReturn($locale);

        $result = (new Session('locale'))->determineLocale($request);

        $this->assertEquals($result, $locale);
    }

    /** @test **/
    public function fallback_if_no_locale_found()
    {
        $fallback = 'de';

        $request = Mockery::mock('Illuminate\Http\Request');
        $session = Mockery::mock('Illuminate\Session\Store');

        $request
            ->shouldReceive('session')
            ->andReturn($session);

        $session
            ->shouldReceive('get')
            ->with('locale', $fallback)
            ->andReturn($fallback);

        $result = (new Session('locale'))->setFallback($fallback)->determineLocale($request);

        $this->assertEquals($result, $fallback);
    }
}
