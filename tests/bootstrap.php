<?php
/**
 * Bootstrap for hca-eea-program-roster tests
 */

use EETests\bootstrap\AddonLoader;

$core_tests_dir = dirname(dirname(dirname(__FILE__))) . '/event-espresso-core/tests/';
//if still don't have $core_tests_dir, then let's check tmp folder.
if (! is_dir($core_tests_dir)) {
    $core_tests_dir = '/tmp/event-espresso-core/tests/';
}
require $core_tests_dir . 'includes/CoreLoader.php';
require $core_tests_dir . 'includes/AddonLoader.php';

define('HCA_PROGRAM_ROSTER_PLUGIN_DIR', dirname(dirname(__FILE__)) . '/');
define('HCA_PROGRAM_ROSTER_TESTS_DIR', HCA_PROGRAM_ROSTER_PLUGIN_DIR . 'tests/');


$addon_loader = new AddonLoader(
    HCA_PROGRAM_ROSTER_TESTS_DIR,
    HCA_PROGRAM_ROSTER_PLUGIN_DIR,
    'hca-eea-program-roster.php'
);
$addon_loader->init();
