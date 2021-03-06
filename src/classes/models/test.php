<?php
/**
 * WP_Framework_Test Classes Models Test
 *
 * @author Technote
 * @copyright Technote All Rights Reserved
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2
 * @link https://technote.space
 */

namespace WP_Framework_Test\Classes\Models;

use PHPUnit_Framework_TestSuite;
use PHPUnit_Framework_TestSuite_DataProvider;
use WP_Framework_Core\Traits\Loader;
use WP_Framework_Presenter\Traits\Presenter;
use WP_Framework_Test\Classes\Tests\Base;
use WP_Framework_Test\Traits\Package;

if ( ! defined( 'WP_CONTENT_FRAMEWORK' ) ) {
	exit;
}

/**
 * Class Test
 * @package WP_Framework_Test\Classes\Models
 */
class Test implements \WP_Framework_Core\Interfaces\Loader, \WP_Framework_Presenter\Interfaces\Presenter {

	use Loader, Presenter, Package;

	/**
	 * @var bool $is_valid
	 */
	private $is_valid = false;

	/**
	 * initialize
	 */
	protected function initialize() {
		if ( ! class_exists( '\PHPUnit_TextUI_Command' ) ) {
			$autoload = $this->get_package_instance()->get_dir() . DS . 'vendor' . DS . 'autoload.php';
			if ( ! file_exists( $autoload ) ) {
				return;
			}
			/** @noinspection PhpIncludeInspection */
			require_once $autoload;

			if ( ! class_exists( '\PHPUnit_TextUI_Command' ) ) {
				return;
			}
		}

		$this->is_valid = true;
	}

	/**
	 * @return bool
	 */
	public function is_valid() {
		return $this->is_valid && count( $this->get_tests() ) > 0;
	}

	/**
	 * @return array
	 */
	private function get_tests() {
		if ( ! $this->is_valid ) {
			return [];
		}

		return $this->get_class_list();
	}

	/**
	 * @return array
	 */
	public function get_test_class_names() {
		return $this->app->array->map( $this->get_tests(), 'get_class_name' );
	}

	/**
	 * @return array
	 */
	protected function get_namespaces() {
		return [
			$this->app->define->plugin_namespace . '\\Classes\\Tests',
		];
	}

	/**
	 * @return bool
	 */
	protected function is_common_cache_class_settings() {
		return true;
	}

	/**
	 * @return string
	 */
	protected function get_instanceof() {
		return '\WP_Framework_Test\Classes\Tests\Base';
	}

	/**
	 * @return array
	 */
	public function do_tests() {
		if ( ! $this->is_valid ) {
			return [];
		}

		Base::set_app( $this->app );
		$results = [];
		foreach ( $this->get_tests() as $class ) {
			$results[] = $this->do_test( $class );
		}

		return $results;
	}

	/**
	 * @param Base $class
	 *
	 * @return array
	 */
	private function do_test( Base $class ) {
		$suite = new PHPUnit_Framework_TestSuite( $class->get_class_name() );
		$suite->setBackupGlobals( false );
		$result = $suite->run();

		$dump = [];
		foreach ( $result->topTestSuite()->tests() as $item ) {
			if ( $item instanceof \WP_Framework_Test\Interfaces\Test ) {
				$dump = array_merge( $dump, $item->get_dump_objects() );
			} elseif ( $item instanceof PHPUnit_Framework_TestSuite_DataProvider ) {
				foreach ( $item->tests() as $item2 ) {
					if ( $item2 instanceof \WP_Framework_Test\Interfaces\Test ) {
						$dump = array_merge( $dump, $item2->get_dump_objects() );
					}
				}
			}
		}

		return [
			$result->wasSuccessful(),
			$this->get_view( 'admin/include/test_result', [
				'result' => $result,
				'class'  => $class,
				'dump'   => $dump,
			] ),
		];
	}
}
