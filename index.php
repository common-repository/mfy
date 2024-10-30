<?php
/*
 * Plugin Name:       MFY Growth Widgets
 * Description:       Give you the power to harness customer base
 * Author:            MFY
 * Author URI:        https://mfy.im
 * License:           GPL-2.0+
 * Version:           2.2.1
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * No direct acces to files are allowed.
 */
if (!defined('WPINC') || !defined('ABSPATH')) {
    die();
}
/**
 *
 * Define Some Plugin related GLOBAL Constants
 */
if (!defined('MFY_GRAVITY_PLUGIN_ROOT')) {
    define('MFY_GRAVITY_PLUGIN_ROOT', plugin_dir_path(__FILE__));
}
require_once plugin_dir_path(__FILE__) . 'classes/growth_tools_core_plugin.php';
require_once MFY_GRAVITY_PLUGIN_ROOT . '/classes/mfy_global_values.php';

if (!defined('MFY_GRAVITY_MBOX_BASE_URL')) {
    define(
        'MFY_GRAVITY_MBOX_BASE_URL',
        MfyGravityValues::get_mfy_gravity_base_url()
    );
}
if (!defined('MFY_GRAVITY_MBOX_TAG')) {
    define('MFY_GRAVITY_MBOX_TAG', MfyGravityValues::get_mfy_gravity_script());
}

/**
 *
 * deactivate hook
 * called when plugin is deactivated
 *
 * delete all the option set by the plugin
 *
 */

function myplugin_deactivate()
{
    delete_option('mfy_config_new');

    delete_option('mfy_user_access_token');
    delete_option('mfy_mbox_details');
}

/**
 *
 * Starting entry to our plugin
 *
 */

function mfyInit()
{
    register_deactivation_hook(__FILE__, 'myplugin_deactivate');
    $mfyGtManager = new MfyGrowthToolsManager();
    $mfyGtManager->run();
}
mfyInit();
