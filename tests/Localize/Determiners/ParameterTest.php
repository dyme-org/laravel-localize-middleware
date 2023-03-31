<?php

namespace Localize\BenConstable\Localize\Determiners;

use Mockery;
use PHPUnit\Framework\TestCase;
use BenConstable\Localize\Determiners\Parameter;

class ParameterTest extends TestCase
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
            ->shouldReceive('input')
            ->with('locale', null)
            ->andReturn($locale);

        $result = (new Parameter('locale'))->determineLocale($request);

        $this->assertEquals($result, $locale);
    }

    /** @test **/
    public function fallback_if_no_locale_found()
    {
        $fallback = 'de';

        $request = Mockery::mock('Illuminate\Http\Request');

        $request
            ->shouldReceive('input')
            ->with('locale', $fallback)
            ->andReturn($fallback);

        $result = (new Parameter('locale'))->setFallback($fallback)->determineLocale($request);

        $this->assertEquals($result, $fallback);
    }
}
