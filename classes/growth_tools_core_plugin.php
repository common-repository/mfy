<?php
if (!defined('ABSPATH')) {
    exit();
}

/**
 * Core Plugin Class
 *
 * Dependencies : class  MfyUtilityFunctions, class MfyGrowthToolsManagerLoader.
 *
 * Enques the array with neccessary data structure to register with wordpress.
 *
 * These datastructure later passed to MfyGrowthToolsManagerLoader.
 *
 * Abstracts lower level wordpress works.
 *
 *
 *
 */
class MfyGrowthToolsManager
{
    protected $loader;

    protected $plugin_slug;

    protected $version;

    public function __construct()
    {
        $this->plugin_slug = 'mfy_gravity';
        $this->version = '1.0.2';

        $this->load_dependencies();
        $this->define_admin_hooks();
    }

    /**
     * Loads dependencies used by this class.
     *
     * Create a refernce to MfyGrowthToolsManagerLoader.
     *
     * private function. Used by this class only
     *
     */

    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) .
            'classes/utility_classes.php'; // class MfyUtilityFunctions

        require_once plugin_dir_path(dirname(__FILE__)) .
            'classes/growth_tools_classes.php'; // class MfyGrowthToolsManagerLoader

        $this->loader = new MfyGrowthToolsManagerLoader();
    }

    /**
     *
     * Defines all the datastructure needed by the MfyGrowthToolsManagerLoader class.
     *
     * All the wordpress related low level codes are abstracted away here.
     *
     * action,hooks,short_code and filter registration is done here.
     *
     */

    private function define_admin_hooks()
    {
        $admin = new MfyUtilityFunctions($this->get_version());

        $this->loader->add_action(
            'admin_menu',
            $admin,
            'mfy_gravity_admin_menu'
        );

        $this->loader->add_action(
            'rest_api_init',
            $admin,
            'mfy_gravity_rest_init'
        );

        //add filters
        $this->loader->add_filter(
            'the_content',
            $admin,
            'mfy_gravity_manage_post_action'
        );

        $this->loader->add_action(
            'wp_head',
            $admin,
            'mfy_gravity_register_script'
        );

         $this->loader->add_action(
            'wp_footer',
            $admin,
            'mfy_gravity_add_corner_widget_div'
        );

        //add short code

        $this->loader->add_short_code(
            'MFY',
            $admin,
            'mfy_gravity_mbox_register_short_code'
        );
    }

    /**
     *
     * calls the MfyGrowthToolsManagerLoader class's run method.
     *
     */

    public function run()
    {
        $this->loader->run();
    }

    /**
     *
     * returns version of the plugin
     */

    public function get_version()
    {
        return $this->version;
    }
}
