<?php

declare(strict_types=1);

namespace Gmazzap\CoreDays24;

use Brain\Monkey;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework;

abstract class TestCase extends Framework\TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
        Monkey\Functions\stubEscapeFunctions();
        Monkey\Functions\stubTranslationFunctions();
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}
