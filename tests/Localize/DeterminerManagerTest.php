<?php

namespace Localize\BenConstable\Localize;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Config;
use Mockery;
use BenConstable\Localize\Determiners;
use BenConstable\Localize\DeterminerManager;
use PHPUnit\Framework\TestCase;

class DeterminerManagerTest extends \Illuminate\Foundation\Testing\TestCase
{
    protected $app;

    public function setUp(): void
    {
        $this->app = Container::getInstance();

        $this->app->offsetSet('config', [
                'localize-middleware' => require(__DIR__ . '/../../src/config/localize-middleware.php'),
                'app' => [
                    'fallback_locale' => 'de'
                ]
        ]);
    }

    public function tearDown(): void
    {

        Mockery::close();
    }

    /** @test **/
    public function create_a_cookie_determiner()
    {
        $manager = new DeterminerManager($this->app);

        $this->assertInstanceOf(Determiners\Cookie::class, $manager->driver('cookie'));
    }

    /** @test **/
    public function create_a_host_determiner()
    {
        $manager = new DeterminerManager($this->app);

        $this->assertInstanceOf(Determiners\Host::class, $manager->driver('host'));
    }

    /** @test **/
    public function create_a_parameter_determiner()
    {
        $manager = new DeterminerManager($this->app);

        $this->assertInstanceOf(Determiners\Parameter::class, $manager->driver('parameter'));
    }

    /** @test **/
    public function create_a_session_determiner()
    {
        $manager = new DeterminerManager($this->app);

        $this->assertInstanceOf(Determiners\Session::class, $manager->driver('session'));
    }

    /** @test **/
    public function create_a_header_determiner()
    {
        $manager = new DeterminerManager($this->app);

        $this->assertInstanceOf(Determiners\Header::class, $manager->driver('header'));
    }

    /** @test **/
    public function create_a_stack_determiner()
    {
        $manager = new DeterminerManager($this->app);

        $determiner = $manager->driver('stack');

        $this->assertInstanceOf(Determiners\Stack::class, $determiner);

        $this->assertCount(1, $determiner->getDeterminers());

        $this->assertInstanceOf(Determiners\Parameter::class, $determiner->getDeterminers()->first());
    }

    /** @test **/
    public function create_a_default_determiner()
    {
        $manager = new DeterminerManager($this->app);

        $this->assertInstanceOf(Determiners\DeterminerInterface::class, $manager->driver());
    }

    public function createApplication()
    {
        return $this->app;
    }
}
