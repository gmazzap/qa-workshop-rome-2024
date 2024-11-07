<?php

declare( strict_types=1 );

namespace Gmazzap\CoreDays24;

use Brain\Monkey\Functions;

/**
 * Plugin test class
 */
class PluginTest extends TestCase {

	/**
	 * Test that lyrics line does not start or end with a space.
	 */
	public function test_lyrics_line_has_no_wrapping_spaces(): void {

		$line = nun_fa_la_stupida_line();

		static::assertFalse( preg_match( '/^\s/', $line ) );
		static::assertFalse( preg_match( '/\s$/', $line ) );
	}

	/**
	 * Test is_evening() works well based on date and time.
	 */
	public function test_is_evening(): void {

		Functions\expect( 'current_datetime' )
			->andReturnValues(
				array(
					\DateTimeImmutable::createFromFormat( 'H:i:s', '23:59:59' ),
					\DateTimeImmutable::createFromFormat( 'H:i:s', '17:59:59' ),
					\DateTimeImmutable::createFromFormat( 'H:i:s', '20:59:59' ),
					\DateTimeImmutable::createFromFormat( 'H:i:s', '00:00:00' ),
				)
			)->ordered();

		static::assertTrue( is_evening() );
		static::assertFalse( is_evening() );
		static::assertTrue( is_evening() );
		static::assertFalse( is_evening() );
	}

	/**
	 * Test that liric line does not start or end with a space.
	 */
	public function test_nun_fa_stupida_does_nothing_if_not_evening(): void {

		Functions\expect( 'current_datetime' )
			->andReturn( \DateTimeImmutable::createFromFormat( 'H:i', '08:00' ) );

		static::expectOutputString( '' );

		nun_fa_la_stupida();
	}

	/**
	 * Test that in the evening the nun_fa_stupida() prints a notice.
	 */
	public function test_nun_fa_stupida_prints_notice_in_the_evening(): void {

		Functions\expect( 'current_datetime' )
			->andReturn( \DateTimeImmutable::createFromFormat( 'H:i', '20:00' ) );

		static::expectOutputRegex( '{class="notice"}' );

		nun_fa_la_stupida();
	}

	/**
	 * Test that in the evening the nun_fa_stupida() prints a etxt containing song title
	 */
	public function test_nun_fa_stupida_prints_title_in_the_evening(): void {

		Functions\expect( 'current_datetime' )
			->andReturn( \DateTimeImmutable::createFromFormat( 'H:i', '20:00' ) );

		static::expectOutputRegex( '{Roma nun fa la stupida stasera}' );

		nun_fa_la_stupida();
	}
}
