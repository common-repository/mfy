<?php

if (!defined('ABSPATH')) {
    exit();
}

if (get_option('mfy_success_msg_show')) {
    echo '<div  class=" mfy notice  notice-success is-dismissible">
            <p>The settings are saved!! Awesome 😇</p>
        </div>';
    delete_option('mfy_success_msg_show');
}

if (get_option('mfy_error_msg_show')) {
    echo '<div  class=" mfy notice  notice-error is-dismissible">
            <p>Some error occured while submitting the form. Check the inputs and try again 😢</p>   
        </div>';
    delete_option('mfy_error_msg_show');
}

if (get_option('mfy_nonce_error_msg_show')) {
    echo '<div  class=" mfy notice  notice-error is-dismissible">
            <p>There was an error validating the input. Try again. If it persists please feel free to contact support 😢</p>   
        </div>';
    delete_option('mfy_nonce_error_msg_show');
}
?>
<div class="wrap mfy">
  
    <div class="cardmfy">
      <div class="titlemfy">
        <h1>mChat Configuration </h1>
    </div>
<form name="gravityConfig" method="post" action="<?php echo admin_url(
      'admin-post.php?action=mfy_gravity_mchat_conf_save'
  ); ?>">
    <table>
     <?php wp_nonce_field(
         'mfy_gravity_mchat_conf_save',
         'mfy_gravity_mchat_conf_save_nonce'
     ); ?>
        <tr>
            <td><p><span style="padding: 2px 5px 0px 0px;" class="dashicons dashicons-facebook"> </span>PageId </p><small>Copy your facebook page id here (<a href="https://help.mfy.im/wordpress-guides/how-to-configure-your-mfy-growth-tools-in-wordpress" target="_blank">Learn more</a>)</small></td>
            <td>
                <input type="number" placeholder="Get ID from MFY dashboard" required name="mfyMchatPageId" value="<?php echo get_option(
                            'mfyMchatPageId'
                        ); ?>" />
            </td>
        </tr>
      </table>
      <div class="mboxheader">
        <h2><span class="dashicons dashicons-layout"></span> mChat Placement</h2>
        <p>Based on the settings below, mChat will be automatically placed on your website. Read our <a href="https://help.mfy.im/wordpress-guides" target="_blank"><b>WordPress guide</b></a> to learn more </p>
      </div>
      <table>
<tr>
  <td><p><span style="padding: 2px 5px 0px 0px;" class="dashicons dashicons-palmtree"> </span>mChat Visibility</p><small>Turn visibility off if you wish to temporarily disable mChat across your website</small></td>
    <td>
          <?php if (get_option('mfyMchatVacationMode')) {
              echo ' <input type="checkbox" id="mfyMchatVacationMode" name="mfyMchatVacationMode" checked/>';
          } else {
              echo ' <input type="checkbox" id="mfyMchatVacationMode" name="mfyMchatVacationMode" />';
          } ?>
    </td>
</tr>
<tr>
    <td>
        </td>
        <td><input type="submit" value="Save settings"  name="configSubmit"/>
    </td>
</tr>
</table>
</form>
</div>
</div>
