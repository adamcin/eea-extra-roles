<?php

define('HCA_PROGRAM_ROSTER_BASENAME', plugin_basename(HCA_PROGRAM_ROSTER_PLUGIN_FILE));
define('HCA_PROGRAM_ROSTER_PATH', plugin_dir_path(__FILE__));
define('HCA_PROGRAM_ROSTER_URL', plugin_dir_url(__FILE__));
define('HCA_PROGRAM_ROSTER_ADMIN', HCA_PROGRAM_ROSTER_PATH . 'admin' . DS);
define('HCA_PROGRAM_ROSTER_DMS_PATH', HCA_PROGRAM_ROSTER_PATH . 'data_migration_scripts' . DS);

/**
 * Class  EE_Roster
 *
 * @package         HcaProgramRoster
 * @author              Seth Shoultes, Chris Reynolds, Brent Christensen, Michael Nelson
 *
 * ------------------------------------------------------------------------
 */
class EE_Roster extends EE_Addon
{


    /**
     * @var string activation_indicator_option_name
     */
    const activation_indicator_option_name = 'hca_program_roster_activation';


    /**
     * register_addon
     */
    public static function register_addon()
    {
        EE_Psr4AutoloaderInit::psr4_loader()->addNamespace('HcaProgramRoster', HCA_PROGRAM_ROSTER_PATH);
// define the plugin directory path and URL
        // register addon via Plugin API
        EE_Register_Addon::register('HcaProgramRoster', array(
            'version' => HCA_PROGRAM_ROSTER_VERSION,
            'min_core_version' => '4.10.10',
            'main_file_path' => HCA_PROGRAM_ROSTER_PLUGIN_FILE,
            'admin_path' => HCA_PROGRAM_ROSTER_ADMIN . 'roster' . DS,
            'admin_callback' => 'additional_admin_hooks',
            'class_name' => 'EE_Roster',
            'config_class' => 'EE_Roster_Config',
            'config_name' => 'EE_Roster',
            'autoloader_paths' => array(
                'HcaProgramRoster_Addon' => HCA_PROGRAM_ROSTER_PATH . 'EE_Roster.class.php',
                'EE_Roster_Config' => HCA_PROGRAM_ROSTER_PATH . 'EE_Roster_Config.php',
                'Roster_Admin_Page' => HCA_PROGRAM_ROSTER_ADMIN . 'roster' . DS . 'Roster_Admin_Page.core.php',
                'Roster_Admin_Page_Init' => HCA_PROGRAM_ROSTER_ADMIN .
                    'roster' . DS . 'Roster_Admin_Page_Init.core.php',
            ),
            'dms_paths' => array(HCA_PROGRAM_ROSTER_DMS_PATH),
            'module_paths' => array(HCA_PROGRAM_ROSTER_PATH . 'EED_Roster.module.php'),
            'shortcode_paths' => array(HCA_PROGRAM_ROSTER_PATH . 'EES_Roster.shortcode.php'),
            'widget_paths' => array(HCA_PROGRAM_ROSTER_PATH . 'EEW_Roster.widget.php'),
            // if plugin update engine is being used for auto-updates. not needed if PUE is not being used.
            'pue_options' => array(
                'pue_plugin_slug' => 'hca-eea-program-roster',
                'checkPeriod' => '24',
                'use_wp_update' => false
            )
        ));
    }


    /**
     *  additional_admin_hooks
     *
     * @access     public
     * @return     void
     */
    public function additional_admin_hooks()
    {
        // is admin and not in M-Mode ?
        if (is_admin() && !EE_Maintenance_Mode::instance()->level()) {
            add_filter('plugin_action_links', array($this, 'plugin_actions'), 10, 2);
        }
    }


    /**
     * plugin_actions
     *
     * Add a settings link to the Plugins page, so people can go straight from the plugin page to the settings page.
     * @param $links
     * @param $file
     * @return array
     */
    public function plugin_actions($links, $file)
    {
        if ($file == HCA_PROGRAM_ROSTER_BASENAME) {
// before other links
            array_unshift($links, '<a href="admin.php?page=hca_program_roster">' .
                __('Settings', 'event_espresso') . '</a>');
        }
        return $links;
    }
}
// End of file EE_Roster.class.php
// Location: wp-content/plugins/hca-eea-program-roster/EE_Roster.class.php
