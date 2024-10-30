<?php
if (!defined('ABSPATH')) {
    exit();
}

class MfyUtilityFunctions
{
    private $version;

    public function __construct($version)
    {
        $this->version = $version;
    }

    public function mfy_gravity_load_widget()
    {
        register_widget('mfy_widget');
    }

    public function mfy_gravity_admin_menu()
    {
        // add_options_page("gravity configuration", "MFY", 1, "gravity", array($this,'gravity_interface'));

        add_menu_page(
            "gravity configuration",
            "MFY",
            "manage_options",
            "mfy_growth_tools_mbox",
            array($this, 'mfy_gravity_mbox_view'),
            'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAdCAYAAACqhkzFAAAABGdBTUEAALGPC/xhBQAAAkxJREFUSA3tkj9s00AUxr9LbKdRIIhCQIG0MHTg38KAGGBl6oBgYGNGAqYCQjAAA2vVqTNLp1YgBmDthhASiohUCULFv6hBVaKGJiUhts/H98621IUKiTWWnu/d+d7vvu+dgdHzvx1Q/wo4PmduBBGuK4XDrHGMQZv5YrGAR++uqX7K2RFYeW7OZnO4qoa45PxG2bSglJ+WJqNC2/Fw7sNNVZeVvwIPLZkXGMO0ygIZjyG7I0prsOgng5VUaR/mLW45tjKjNpx4CXhlTK7ZxH1tML3lY+prB3vetICmBvSAu7jTyPFlwKVBs00pwSVO7/HrHavwiTFjuonX7NHpkKeGVMIcAfPlz8DKJhVxDjce3S75G8y5lIhkhsbqLTVpneg1PBCYQHwq8hOYzM9MAHkq1L8YPR4mY0QMZaUwqwqYODlvdlnLLLwoatIQlQKTIB8HqKxO+xnZLRIIVEIjiVncCmBwooRBDDSoiCoLSmDWOmvkkDwLNS1GYjln4AQBIVx0eWNONoW/X7qitLXsG9Sk0FpNwKl1GXuEhYyga5Bb34LqDqE7fV4MP0aRtc4OzPN8uTtra472zlvLAtymVpT2fghMY+9aAx5/xDCbhVPaDXgsz7nyC738NKMWhGUV3j2qnhH2kKFt78R2opjqEXGxWKvCqX+HXu/CBCH0MEAUspkDf9ar4LLA5EkuKJ7cXjWnAh8XWD9FYGaz0Z/sNvtHvr0dep2n1ZoaL7Yz+wsms68QugeLVbc8vvzxcf5LXD16jzow6sCoAzt04A9+miemXh6DRQAAAABJRU5ErkJggg==',
            65
        );

        add_submenu_page(
            'mfy_growth_tools_mbox',
            'MFY-MBOX',
            'mBox',
            "manage_options",
            'mfy_growth_tools_mbox',
            array($this, 'mfy_gravity_mbox_view')
        );

        add_submenu_page(
            'mfy_growth_tools_mbox',
            'MFY-MCHAT',
            'mChat',
            "manage_options",
            'mfy_growth_tools_mchat',
            array($this, 'mfy_gravity_mchat_view')
        );
    }

    public function mfy_gravity_mbox_view()
    {
        require_once MFY_GRAVITY_PLUGIN_ROOT . '/views/mfy_mbox_conf.php';
    }

    public function mfy_gravity_mchat_view()
    {
        require_once MFY_GRAVITY_PLUGIN_ROOT . '/views/mfy_mchat_conf.php';
    }

    public function mfy_gravity_mbox_conf_save_handler()
    {
        if (
            isset($_POST) &&
            wp_verify_nonce(
                $_POST['mfy_gravity_mbox_conf_save_nonce'],
                'mfy_gravity_mbox_conf_save'
            )
        ) {
            $mfyMboxError = 0;
            if (isset($_POST['mfyMboxPostOption'])) {
                update_option(
                    'mfyMboxPostOption',
                    esc_html(
                        sanitize_text_field(trim($_POST['mfyMboxPostOption']))
                    )
                );
            }
            if (isset($_POST['mfyMboxPageId'])) {
                $mfyMboxPageId = esc_html(
                    sanitize_text_field(trim($_POST['mfyMboxPageId']))
                );
                if (ctype_digit($mfyMboxPageId)) {
                    update_option('mfyMboxPageId', $mfyMboxPageId);
                } else {
                    // echo("Error in page Id");
                    $mfyMboxError = 1;
                    update_option('mfy_error_msg_show', true);
                }
            }
            if (isset($_POST['mfyMboxPageOption'])) {
                update_option(
                    'mfyMboxPageOption',
                    esc_html(trim($_POST['mfyMboxPageOption']))
                );
            }
            update_option(
                'mfyMboxVacationMode',
                esc_html(trim($_POST['mfyMboxVacationMode']))
            );

            if (!$mfyMboxError) {
                update_option('mfy_success_msg_show', true);
            }

            header(
                "location:" .
                    get_option('siteurl') .
                    "/wp-admin/admin.php?page=mfy_growth_tools_mbox"
            );
        } else {
            update_option('mfy_nonce_error_msg_show', true);
            header(
                "location:" .
                    get_option('siteurl') .
                    "/wp-admin/admin.php?page=mfy_growth_tools_mbox"
            );
        }
    }

    public function mfy_gravity_mchat_conf_save_handler()
    {
        if (
            isset($_POST) &&
            wp_verify_nonce(
                $_POST['mfy_gravity_mchat_conf_save_nonce'],
                'mfy_gravity_mchat_conf_save'
            )
        ) {
            $mfyMchatError = 0;
            if (isset($_POST['mfyMchatPageId'])) {
                $mfyMchatPageId = esc_html(
                    sanitize_text_field(trim($_POST['mfyMchatPageId']))
                );
                if (ctype_digit($mfyMchatPageId)) {
                    update_option('mfyMchatPageId', $mfyMchatPageId);
                } else {
                    // echo("Error in page Id");
                    $mfyMchatError = 1;
                    update_option('mfy_error_msg_show', true);
                }
            }
            update_option(
                'mfyMchatVacationMode',
                esc_html(trim($_POST['mfyMchatVacationMode']))
            );
            if (!$mfyMchatError) {
                update_option('mfy_success_msg_show', true);
            }

            header(
                "location:" .
                    get_option('siteurl') .
                    "/wp-admin/admin.php?page=mfy_growth_tools_mchat"
            );
        } else {
            update_option('mfy_nonce_error_msg_show', true);
            header(
                "location:" .
                    get_option('siteurl') .
                    "/wp-admin/admin.php?page=mfy_growth_tools_mchat"
            );
        }
    }

    public function mfy_gravity_manage_post_action($postObject)
    {
        global $post;
        if (!get_option('mfyMboxVacationMode')) {
            if (!is_home() || !is_front_page()) {
                if (is_page()) {
                    if (get_option('mfyMboxPageOption') == 'AFTER_POST') {
                        $postObject .= MFY_GRAVITY_MBOX_TAG;
                    } elseif (
                        get_option('mfyMboxPageOption') == 'BEFORE_POST'
                    ) {
                        $postObject = MFY_GRAVITY_MBOX_TAG . $postObject;
                    } elseif (
                        get_option('mfyMboxPageOption') == 'BEFORE_AND_AFTER'
                    ) {
                        $postObject =
                            MFY_GRAVITY_MBOX_TAG .
                            $postObject .
                            MFY_GRAVITY_MBOX_TAG;
                    }

                    return $postObject;
                } else {
                    if (is_singular()) {
                        if (get_option('mfyMboxPostOption') == 'AFTER_POST') {
                            $postObject .= MFY_GRAVITY_MBOX_TAG;
                        } elseif (
                            get_option('mfyMboxPostOption') == 'BEFORE_POST'
                        ) {
                            $postObject = MFY_GRAVITY_MBOX_TAG . $postObject;
                        } elseif (
                            get_option('mfyMboxPostOption') ==
                            'BEFORE_AND_AFTER'
                        ) {
                            $postObject =
                                MFY_GRAVITY_MBOX_TAG .
                                $postObject .
                                MFY_GRAVITY_MBOX_TAG;
                        }
                    }
                }
            }
            return $postObject;
        }
        return $postObject;
    }

    public function mfy_gravity_register_style_scripts()
    {
        wp_enqueue_style(
            'style',
            plugins_url(
                '/css/mfystyle.css',
                MFY_GRAVITY_PLUGIN_ROOT . '/index.php'
            )
        );
    }

    public function mfy_gravity_register_chat_script()
    {
        if (
            !trim(get_option('mfyMchatVacationMode')) &&
            trim(get_option("mfyMchatPageId"))
        ) {
            echo MFY_GRAVITY_MCHAT_TAG;
        }
    }

    public function mfy_gravity_admin_notice()
    {
        if (
            !get_option('mfyMboxVacationMode') &&
            !trim(get_option('mfyMboxPageId'))
        ) {
            echo '<div class=" mfy notice notice-error  is-dismissible">
            <p>PageId is not set in your <a href="' .
                get_option('siteurl') .
                '/wp-admin/admin.php?page=mfy_growth_tools_mbox">MFY mBox plugin settings</a>😢.</p>
        </div>';
        }
        if (
            !get_option('mfyMchatVacationMode') &&
            !trim(get_option('mfyMchatPageId'))
        ) {
            echo '<div class=" mfy notice notice-error  is-dismissible">
            <p>PageId is not set in your <a href="' .
                get_option('siteurl') .
                '/wp-admin/admin.php?page=mfy_growth_tools_mchat">MFY mChat plugin settings</a>😢.</p>
        </div>';
        }
        if (
            (
                (get_option('mfyMboxVacationMode') == "on") &&
                    (get_option('mfyMchatVacationMode') == "on")
            )
        ) {
            echo '<div class="mfy notice notice-error is-dismissible">
            <p>🚨 Growth tools are currently invisible on your website. Go to <a href="' .
                get_option('siteurl') .
                '/wp-admin/admin.php?page=mfy_growth_tools_mbox">MFY plugin settings</a> to turn visibility ON</p>
        </div>';
        }
    }

    public function mfy_gravity_mbox_register_short_code($attribs)
    {
        if (!get_option('mfyMboxVacationMode')) {
            return MFY_GRAVITY_MBOX_TAG;
        }
    }
}
