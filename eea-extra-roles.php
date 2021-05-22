<?php

/*
Plugin Name: Extra Roles for Event Espresso
Plugin URI: https://github.com/adamcin/eea-extra-roles
Description: Add-on providing additional roles for Event Espresso.
Version: 1.0
Author: Mark Adamcin
Author URI: https://github.com/adamcin
Copyright 2021 Mark Adamcin (email : adamcin@gmail.com)

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

  http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
 *
 * ------------------------------------------------------------------------
 *
 * HCA Program Roster
 *
 * Event Registration Listing Portal Plugin for WordPress
 *
 * @ package		ExtraRoles
 * @ author			Mark Adamcin
 * @ copyright	    (c) 2021 Mark Adamcin  All Rights Reserved.
 * @ license		https://www.apache.org/licenses/LICENSE-2.0
 * @ link			https://github.com/adamcin/eea-extra-roles
 * @ version	 	1.0
 *
 * ------------------------------------------------------------------------
*/
const EE_CORE_VERSION_REQUIRED = '4.10.10.p';
const EE_EXTRA_ROLES_VERSION = '1.0';
const EE_EXTRA_ROLES_PLUGIN_FILE = __FILE__;

function eea_extra_roles_deactivation()
{
    if (class_exists('EE_ExtraRoles')) {
        EE_ExtraRoles::deregister_addon();
    }
}
register_deactivation_hook(__FILE__, 'eea_extra_roles_deactivation');

function load_eea_extra_roles_class()
{
    // check for duplicate copy of HcaProgramRoster addon
    if (class_exists('EE_ExtraRoles')) {
        EE_Error::add_error(
            sprintf(
                __(
                    'It appears there are multiple copies of the HCA Program Roster Add-on installed on your server.%1$sPlease remove (delete) all copies except for this version: "%2$s"',
                    'event_espresso'
                ),
                '<br />',
                EE_EXTRA_ROLES_VERSION
            ),
            __FILE__,
            __FUNCTION__,
            __LINE__
        );
        add_action('admin_notices', 'eea_extra_roles_activation_error');
        return;
    }
    if (class_exists('EE_Addon')) {
        // eea_extra_roles_version
        require_once(plugin_dir_path(__FILE__) . 'EE_ExtraRoles.class.php');
        EE_ExtraRoles::register_addon();
    } else {
        add_action('admin_notices', 'eea_extra_roles_activation_error');
    }
}

add_action('AHEE__EE_System__load_espresso_addons', 'load_eea_extra_roles_class');

function eea_extra_roles_activation_check()
{
    if (! did_action('AHEE__EE_System__load_espresso_addons')) {
        add_action('admin_notices', 'eea_extra_roles_activation_error');
    }
}

add_action('init', 'eea_extra_roles_activation_check', 1);

function eea_extra_roles_activation_error()
{
    unset($_GET['activate']);
    unset($_REQUEST['activate']);
    if (! function_exists('deactivate_plugins')) {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    deactivate_plugins(plugin_basename(EE_EXTRA_ROLES_PLUGIN_FILE));
    ?>
    <div class="error">
        <p><?php
            printf(
                __(
                    'Extra Roles Add-on could not be activated. Please ensure that Event Espresso version %s or higher is running',
                    'event_espresso'
                ),
                EE_CORE_VERSION_REQUIRED
            );
            ?>
        </p>
    </div>
    <?php
}