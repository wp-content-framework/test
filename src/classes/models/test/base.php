<?php
/**
 * WP_Framework_Test Classes Models Test Base
 *
 * @author Technote
 * @copyright Technote All Rights Reserved
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2
 * @link https://technote.space
 */

namespace WP_Framework_Test\Classes\Models\Test;

use PHPUnit\Framework\TestCase;

if ( ! defined( 'WP_CONTENT_FRAMEWORK' ) ) {
	exit;
}

if ( class_exists( '\PHPUnit\Framework\TestCase' ) ) {
	class Base extends TestCase {
	}
} else {
	// phpcs:ignore Generic.Classes.DuplicateClassName.Found,Generic.Files.OneObjectStructurePerFile.MultipleFound
	class Base {
	}
}
