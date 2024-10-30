<?php
if (!defined('ABSPATH')) {
    exit();
}

/**
 *
 * Plugin related registrations are done here.
 *
 * Defines three arrays $actions,$filters and $shortcodes
 *
 *
 * Register actions filters and shortcodes with wordpress.
 *
 * Appropriate references are maintained.
 *
 *
 *
 */
class MfyGrowthToolsManagerLoader
{
    protected $actions;

    protected $filters;

    protected $shortcodes;

    public function __construct()
    {
        $this->actions = array();
        $this->filters = array();
        $this->shortcodes = array();
    }
    /**
     * enque all the wordpress action related params to array
     *
     * @param string $hook - Wordpress action name.
     *
     * @param string $callback  - Callback function name for $hook.
     *
     * @param object $component - Object with which the callback function associated.
     *
     */
    public function add_action($hook, $component, $callback)
    {
        $this->actions = $this->add(
            $this->actions,
            $hook,
            $component,
            $callback
        );
    }

    /**
     * enque all the wordpress filter related params to array
     *
     * @param string $hook - Wordpress action name.
     *
     * @param string $callback  - Callback function name for $hook.
     *
     * @param object $component - Object with which the callback function associated.
     *
     */

    public function add_filter($hook, $component, $callback)
    {
        $this->filters = $this->add(
            $this->filters,
            $hook,
            $component,
            $callback
        );
    }

    /**
     * enque all the wordpress add_short_code related params to array
     *
     * @param string $hook - Wordpress action name.
     *
     * @param string $callback  - Callback function name for $hook.
     *
     * @param object $component - Object with which the callback function associated.
     *
     */

    public function add_short_code($hook, $component, $callback)
    {
        $this->shortcodes = $this->add(
            $this->shortcodes,
            $hook,
            $component,
            $callback
        );
    }

    /**
     * Create the array data structure needed by the action ,filter and short code.
     *
     * More like a Factory.
     *
     * @param string $hooks -   action|filter|shortcode array.
     *
     * @param $hook -the action name
     *
     * @param string $callback  - Callback function name for $hook.
     *
     * @param object $component - Object with which the callback function associated.
     *
     *
     * @return array $hooks
     *
     */

    private function add($hooks, $hook, $component, $callback)
    {
        $hooks[] = array(
            'hook' => $hook,
            'component' => $component,
            'callback' => $callback
        );

        return $hooks;
    }

    /**
     *
     * runs the actual wordpress function.
     *
     * add_filter,add_action, and add_shortcode
     *
     * Low level work is done here
     */

    public function run()
    {
        foreach ($this->filters as $hook) {
            add_filter($hook['hook'], array(
                $hook['component'],
                $hook['callback']
            ));
        }

        foreach ($this->actions as $hook) {
            add_action($hook['hook'], array(
                $hook['component'],
                $hook['callback']
            ));
        }

        foreach ($this->shortcodes as $hook) {
            add_shortcode($hook['hook'], array(
                $hook['component'],
                $hook['callback']
            ));
        }
    }
}
