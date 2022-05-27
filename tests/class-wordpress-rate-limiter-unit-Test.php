<?php
/**
 *
 *
 * @package brianhenryie/bh-wp-rate-limiter
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WP_Rate_Limiter;

use ReflectionClass;

/**
 * @covers BrianHenryIE\WP_Rate_Limiter\WordPress_Rate_Limiter
 */
class WordPress_Rate_Limiter_Unit_Test extends \Codeception\Test\Unit {

	/**
	 * Caused a fatal error when IPv6 : character was used, which is disallowed by wp-oop/transient-cache.
	 *
	 * @covers ::escape_key
	 */
	public function test_reserved_characters() {

		$class  = new ReflectionClass( WordPress_Rate_Limiter::class );
		$method = $class->getMethod( 'escape_key' );
		$method->setAccessible( true );

		$sut = $this->makeEmptyExcept( WordPress_Rate_Limiter::class, 'escape_key' );

		$result = $method->invokeArgs( $sut, array( '2603:3006:1095:c000:28ab:2cde:6b0f:c6eb' ) );

		$this->assertEquals( '2603-3006-1095-c000-28ab-2cde-6b0f-c6eb', $result );
	}
}
