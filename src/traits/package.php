<?php
/**
 * WP_Framework_Test Traits Package
 *
 * @version 0.0.1
 * @author technote-space
 * @since 0.0.1
 * @copyright technote-space All Rights Reserved
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2
 * @link https://technote.space
 */

namespace WP_Framework_Test\Traits;

if ( ! defined( 'WP_CONTENT_FRAMEWORK' ) ) {
	exit;
}

/**
 * Trait Package
 * @package WP_Framework_Test\Traits
 * @property \WP_Framework $app
 */
trait Package {

	/**
	 * @return string
	 */
	public function get_package() {
		return 'test';
	}

}