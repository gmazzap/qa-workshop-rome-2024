<?php

declare( strict_types=1 );

namespace Gmazzap\CoreDays24;

use Brain\Monkey;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework;

/**
 * Base test case class
 */
abstract class TestCase extends Framework\TestCase {

	use MockeryPHPUnitIntegration;

	/**
	 * Set up the tests
	 *
	 * @return void
	 */
	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();
		Monkey\Functions\stubEscapeFunctions();
		Monkey\Functions\stubTranslationFunctions();
		Monkey\Functions\stubs(
			array(
				'get_user_locale' => 'en_US',
			)
		);

		require_once getenv( 'LIB_DIR' ) . '/qa-workshop-rome-2024.php';
	}

	/**
	 * Tear down tests
	 *
	 * @return void
	 */
	protected function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}
}
