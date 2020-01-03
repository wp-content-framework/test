<?php
/**
 * WP_Framework_Test Traits Test
 *
 * @author Technote
 * @copyright Technote All Rights Reserved
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2
 * @link https://technote.space
 */

namespace WP_Framework_Test\Traits;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use WP_Framework;
use WP_Framework_Core\Traits\Hook;
use WP_Framework_Core\Traits\Singleton;

if ( ! defined( 'WP_CONTENT_FRAMEWORK' ) ) {
	exit;
}

/**
 * Trait Test
 * @package WP_Framework_Test\Traits
 * @property WP_Framework $app
 * @mixin TestCase
 */
trait Test {

	use Singleton, Hook;

	/**
	 * @var array $objects
	 */
	private $objects = [];

	/**
	 * Test constructor.
	 *
	 * @param mixed $arg1
	 * @param mixed $arg2
	 * @param mixed $arg3
	 *
	 * @throws ReflectionException
	 */
	public function __construct( $arg1 = null, $arg2 = [], $arg3 = '' ) {
		$args = func_get_args();
		if ( count( $args ) > 1 && $args[0] instanceof WP_Framework && $args[1] instanceof ReflectionClass ) {
			// Singleton
			$this->init( ...$args );
		} elseif ( count( $args ) > 2 ) {
			// \PHPUnit_Framework_TestCase
			$reflection_class = new ReflectionClass( '\PHPUnit_Framework_TestCase' );
			if ( ! is_null( $arg1 ) ) {
				$this->setName( $arg1 );
			}
			$data = $reflection_class->getProperty( 'data' );
			$data->setAccessible( true );
			$data->setValue( $this, $arg2 );
			$data->setAccessible( false );
			$data_name = $reflection_class->getProperty( 'dataName' );
			$data_name->setAccessible( true );
			$data_name->setValue( $this, $arg3 );
			$data_name->setAccessible( false );
		}
	}

	/**
	 * @return string
	 */
	public function get_test_slug() {
		return $this->get_file_slug();
	}

	/**
	 * @param mixed $obj
	 */
	protected function dump( $obj ) {
		$this->objects[] = print_r( $obj, true ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_print_r
	}

	/**
	 * @return bool
	 */
	public function has_dump_objects() {
		return ! empty( $this->objects );
	}

	/**
	 * @return array
	 */
	public function get_dump_objects() {
		return $this->objects;
	}
}
