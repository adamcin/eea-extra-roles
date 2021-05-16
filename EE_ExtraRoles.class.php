<?php

const EE_EXTRA_ROLES_ADDON_NAME = 'EE4 Extra Roles';
define('EE_EXTRA_ROLES_BASENAME', plugin_basename(EE_EXTRA_ROLES_PLUGIN_FILE));
define('EE_EXTRA_ROLES_PATH', plugin_dir_path(__FILE__));
define('EE_EXTRA_ROLES_URL', plugin_dir_url(__FILE__));

/**
 * Class  EE_Roster
 *
 * @package         HcaProgramRoster
 * @author              Seth Shoultes, Chris Reynolds, Brent Christensen, Michael Nelson
 *
 * ------------------------------------------------------------------------
 */
class EE_ExtraRoles extends EE_Addon
{


    /**
     * @var string activation_indicator_option_name
     */
    const activation_indicator_option_name = 'eea_extra_roles_activation';

    /**
     * deregister_addon
     */
    public static function deregister_addon()
    {
        EE_Register_Addon::deregister(EE_EXTRA_ROLES_ADDON_NAME);
        // downgrade ee_events_facilitator role to Subscriber equivalent on deactivation.
        EE_Registry::instance()->CAP->removeCaps(array('ee_events_facilitator' =>
            array_diff(EE_Registry::instance()->CAP->get_ee_capabilities('ee_events_facilitator'), array('read'))));
    }

    /**
     * register_addon
     */
    public static function register_addon()
    {
        EE_Psr4AutoloaderInit::psr4_loader()->addNamespace('ExtraRoles', EE_EXTRA_ROLES_PATH);
    // define the plugin directory path and URL
        // register addon via Plugin API
        EE_Register_Addon::register(EE_EXTRA_ROLES_ADDON_NAME, array(
            'version' => EE_EXTRA_ROLES_VERSION,
            'min_core_version' => '4.10.10',
            'main_file_path' => EE_EXTRA_ROLES_PLUGIN_FILE,
            'class_name' => 'EE_ExtraRoles',
            'autoloader_paths' => array(
                'EE_ExtraRoles' => EE_EXTRA_ROLES_PATH . 'EE_ExtraRoles.class.php'
            ),
            'capabilities' => array(
                'ee_events_facilitator' => array(
                    'read',
                    'ee_read_ee',
                    'ee_read_events',
                    'ee_read_event',
                    'ee_read_others_events',
                    'ee_read_private_events',
                    'ee_edit_events',
                    'ee_edit_event',
                    // 'ee_edit_published_events',
                    'ee_edit_others_events',
                    'ee_edit_private_events',
                    'ee_read_registrations',
                    'ee_read_others_registrations',
                    'ee_edit_registrations',
                    'ee_edit_others_registrations',
                )
            ),
            // if plugin update engine is being used for auto-updates. not needed if PUE is not being used.
            'pue_options' => array(
                'pue_plugin_slug' => 'eea-extra-roles',
                'checkPeriod' => '24',
                'use_wp_update' => false
            )
        ));
    }
}