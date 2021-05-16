<?php

/**
 * Roster_Admin_Page class
 *
 * This is the init for the HCA Program Roster Addon Admin Pages.  See EE_Admin_Page_Init for method inline docs.
 *
 * @package          Event Espresso
 * @subpackage       admin/Roster_Admin_Page.core.php
 * @author           Mark Adamcin
 *
 * ------------------------------------------------------------------------
 */
class Roster_Admin_Page_Init extends EE_Admin_Page_Init
{




    /**
     *      constructor
     *      @Constructor
     *      @access public
     *      @return void
     */
    public function __construct()
    {

        do_action('AHEE_log', __FILE__, __FUNCTION__, '');

        define('ROSTER_PG_SLUG', 'hca_program_roster');
        define('ROSTER_LABEL', __('Program Roster', 'event_espresso'));
        define('HCA_PROGRAM_ROSTER_ADMIN_URL', admin_url('admin.php?page=' . ROSTER_PG_SLUG));
        define(
            'HCA_PROGRAM_ROSTER_ADMIN_ASSETS_PATH',
            HCA_PROGRAM_ROSTER_ADMIN . 'roster' . DS . 'assets' . DS
        );
        define(
            'HCA_PROGRAM_ROSTER_ADMIN_ASSETS_URL',
            HCA_PROGRAM_ROSTER_URL . 'admin' . DS . 'roster' . DS . 'assets' . DS
        );
        define(
            'HCA_PROGRAM_ROSTER_ADMIN_TEMPLATE_PATH',
            HCA_PROGRAM_ROSTER_ADMIN . 'roster' . DS . 'templates' . DS
        );
        define(
            'HCA_PROGRAM_ROSTER_ADMIN_TEMPLATE_URL',
            HCA_PROGRAM_ROSTER_URL . 'admin' . DS . 'roster' . DS . 'templates' . DS
        );

        parent::__construct();
        $this->_folder_path = HCA_PROGRAM_ROSTER_ADMIN . 'roster' . DS;
    }





    protected function _set_init_properties()
    {
        $this->label = ROSTER_LABEL;
        $this->menu_label = ROSTER_LABEL;
        $this->menu_slug = ROSTER_PG_SLUG;
        $this->capability = 'administrator';
    }



    /**
     *       sets vars in parent for creating admin menu entry
     *
     *       @access         public
     *       @return         mixed
     */
    public function get_menu_map()
    {
        if (version_compare(EVENT_ESPRESSO_VERSION, '4.4.0.dev', '>=')) {
            return $this->_menu_map;
        } else {
            $map = array(
                'group' => 'settings',
                'menu_order' => 25,
                'show_on_menu' => true,
                'parent_slug' => 'events'
            );
            return $map;
        }
    }


    protected function _set_menu_map()
    {
        $this->_menu_map = new EE_Admin_Page_Sub_Menu(array(
            'menu_group' => 'settings',
            'menu_order' => 25,
            'show_on_menu' => true,
            'parent_slug' => 'espresso_events',
            'menu_slug' => ROSTER_PG_SLUG,
            'menu_label' => ROSTER_LABEL,
            'capability' => 'administrator',
            'admin_init_page' => $this
        ));
    }
}
