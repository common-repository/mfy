<?php
if (!defined('ABSPATH')) {
    exit();
}
class mfy_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Base ID of your widget
            'mfy_widget',

            // Widget name will appear in UI
            __('MFY: mBox', 'mfy_widget_domain'),

            // Widget description
            array(
                'description' => __('Subscription box', 'mfy_widget_domain')
            )
        );
    }

    // Creating widget front-end

    public function widget($args, $instance)
    {
        // $title = apply_filters( 'widget_title', $instance['title'] );
        if (!get_option('mfyMboxVacationMode')) {
            echo MFY_GRAVITY_MBOX_TAG;
        }
    }
} // Class mfy_widget ends here
