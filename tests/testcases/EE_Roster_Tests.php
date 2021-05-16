<?php
/**
 * Contains test class for HcaProgramRoster.class.php
 *
 * @since  		1.0
 * @package     HcaProgramRoster
 * @subpackage 	tests
 */


/**
 * Test class for EE_Roster.class.php
 *
 * @since 		1.0
 * @package 		Event Espresso
 * @subpackage 	tests
 */
class EE_Roster_Tests extends EE_UnitTestCase {

	function test_EE_Roster_instance() {
        $EE_Roster = new EE_Roster();
		$this->assertTrue( $EE_Roster instanceof EE_Roster );
	}
}
