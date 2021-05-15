<?php
/**
 * Contains test class for HcaProgramRoster.class.php
 *
 * @since  		1.0
 * @package     HcaProgramRoster
 * @subpackage 	tests
 */


/**
 * Test class for HcaProgramRoster.class.php
 *
 * @since 		1.0
 * @package 		Event Espresso
 * @subpackage 	tests
 */
class HcaProgramRoster_Addon_Tests extends EE_UnitTestCase {

	function test_HcaProgramRoster_Addon_instance() {
        $HcaProgramRoster = new HcaProgramRoster_Addon();
		$this->assertTrue( $HcaProgramRoster instanceof HcaProgramRoster_Addon );
	}
}
