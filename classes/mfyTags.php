<?php
if (!defined('ABSPATH')) {
    exit();
}
class MFY_Gravity_Tags
{
    private function __construct()
    {
    }
    private function __clone()
    {
    }

    static function get_Mfy_Gravity_Base_Url()
    {
        return (
            'https://mbox-widget.mfy.im/' .
            esc_html(trim(get_option('mfyMboxPageId')))
        );
    }

    static function get_Mfy_Gravity_mBox_Tag()
    {
        return (
            '<script>
        window.addEventListener("message", function (m) {
            if (!m.data.height || !m.data.name) return; document.getElementsByName(m.data.name)[0].height = m.data.height;
        });
        document.currentScript.insertAdjacentHTML("beforebegin", "<iframe name=\"mfy-" + Math.random().toString(36).substr(2, 9) + "\" src=\"' .
            self::get_Mfy_Gravity_Base_Url() .
            '\" frameborder=0 width=\"100%\" height=0></iframe>");
    </script>
'
        );
    }

    static function get_Mfy_Gravity_mChat_Tag()
    {
        return (
            '<script>
        window.addEventListener("load", function () {
            var s = document.createElement("script");
            s.src = "//mchat-widget.mfy.im/app.js";
            s.async = true;
            window.MFYW = { pageId: "' .
            esc_html(trim(get_option('mfyMchatPageId'))) .
            '" };
            document.body.appendChild(s);
        })
</script>'
        );
    }
}
