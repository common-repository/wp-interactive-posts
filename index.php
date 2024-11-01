<?php  
/* 
Plugin Name: WP Interactive Posts
Plugin URI: http://googleplus-one.co.uk 
Description: Plugin for displaying interactive posts on Google Plus
Author: GooglePlus-One.Co.Uk
Version: 1.1
Author URI: http://googleplus-one.co.uk
*/  
?>
<?php

function wpipp_delete_plugin_options() {
    delete_option('wpipp_options');
}

function wpipp_init() {
    register_setting('wpipp_plugin_options', 'wpipp_options', 'wpipp_validate_options');
}

function wpipp_validate_options($input) {
    return $input;
}

function wpipp_add_options_page() {
	$file = __FILE__;
	add_options_page('WP Interactive Posts Settings', 'WP Interactive Posts', 'manage_options', $file, 'wpipp_render_form');
}

function wpipp_plugin_action_links($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $wpipp_links = '<a href="' . get_admin_url() . 'options-general.php?page=wp-interactive-posts/index.php">' . __('Settings') . '</a>';
        array_unshift($links, $wpipp_links);
    }
    return $links;
}



function wpipp_render_form() {
    ?>
	
    <div style='flaot:left;' class='metabox-holder'>
        <table>
            <tr>
                <td>
                    <h2 style='color: #CA2D23;font-family: georgia;font-size: 3.5em;font-weight: normal;'>WP Interactive Posts</h2>
                </td>
            </tr>
        </table>
		<div style='float:right;width:300px;margin-right:20px;'>
			<a href='http://googleplus-businesspages.com/' target='_blank'>
				<img src='<?php echo plugin_dir_url(__FILE__);?>/google-business.jpg' alt='GooglePlus-BusinessPages.com'/>
			</a>
		</div>
        
        <form method="post" action="options.php" style='width:750px;float:left;'>
			<div style="display:inline;font-style:italic;font-size:11px;padding-left:10px;"><b>Important:</b> Click 'save settings' to save your settings. </div>
    <?php settings_fields('wpipp_plugin_options'); ?>
            <?php $options = get_option('wpipp_options');?>
            <table class="form-table postbox">

                <tr valign="top">
                    <td style='padding:0;width:220px;'>
                        <h3>Name</h3>
                    </td>
                    <td style='padding:0;width:220px;'>
                        <h3>Value</h3>
                    </td>
                    <td style='padding:0;'>
                        <h3>Description</h3>
                    </td>
                </tr>

                <tr valign="top">
                    <td style="padding:5px 0;">
                        <label style="padding:10px;font-weight:bold;">
                            WP Interactive Posts
                        </label>
                    </td>
                    <td style="padding:5px 0;margin-left:5px;">
                        <table>
                            <tr>
                                <td style="padding:0px;margin:0px;">
                                    <select id ='status' name="wpipp_options[status]">
                                        <option selected="selected" <?php if(!empty($options['status']) && $options['status'] == 'enabled') echo "selected='selected'";?> value="enabled">Enable</option>
                                        <option value="disabled" <?php if(!empty($options['status']) && $options['status'] == 'disabled') echo "selected='selected'";?>>Disable</option>
                                    </select>
                                </td>
                            </tr>
                        </table>

                    <td style="margin:5px 0;">
                        <p style="margin:0;margin-left:10px;font-style:italic;font-size:11px;">
                            Enables WP Interactive Posts for site.
                        </p>
                    </td>
                </tr>


                <tr valign="top">
                    <td style="padding:5px 0;">
                        <label style="padding:10px;font-weight:bold;">
                            Client ID
                        </label>
                    </td>
                    <td style="padding:5px 0;margin-left:5px;">
                        <table>
                            <tr>
                                <td style="padding:0px;margin:0px;">
                                    <input id='client_id' style="width: 220px;" type="text" size="57" name="wpipp_options[client_id]" value="<?php if (!empty($options['client_id'])) echo $options['client_id']; ?>" />
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="margin:5px 0;">
                        <p style="margin:0;margin-left:10px;font-style:italic;font-size:11px;">
                            Client ID for Google Project. Click <a href="https://code.google.com/apis/console/">here</a> for details.
							<br/>example : "xxxxx.apps.googleusercontent.com";
                        </p>
                    </td>
                </tr>

                <tr valign="top">
                    <td style="padding:5px 0;">
                        <label style="padding:10px;font-weight:bold;">
                            Call To Action
                        </label>
                    </td>
                    <td style="padding:5px 0;margin-left:5px;">
                        <table>
                            <tr>
                                <td style="padding:0px;margin:0px;">
                                    <select id='call_to_action' name='wpipp_options[call_to_action]'>
<?php
$callToActionArray = array (
	'ACCEPT','ACCEPT_GIFT','ADD','ADD_FRIEND','ADD_ME','ADD_TO_CALENDAR','ADD_TO_CART','ADD_TO_FAVORITES','ADD_TO_QUEUE','ADD_TO_WISH_LIST','ANSWER','ANSWER_QUIZ',
	'APPLY','ASK','ATTACK','BEAT','BID','BOOK','BOOKMARK','BROWSE','BUY','CAPTURE','CHALLENGE','CHANGE','CHALLENGE','CHAT','CHANGE','CHECKIN','COLLECT','COMMENT',
	'COMPARE','COMPLAIN','CONFIRM','CONNECT','CONTRIBUTE','COOK','CREATE','DEFEND','DINE','DISCOVER','DISCUSS','DONATE','DOWNLOAD','EARN','EAT','EXPLAIN','FIND',
	'FIND_A_TABLE','FOLLOW','GET','GIFT','GIVE','GO','HELP','IDENTIFY','INSTALL','INSTALL_APP','INTRODUCE','INVITE','JOIN','JOIN_ME','LEARN','LEARN_MORE','LISTEN',
	'MAKE','MATCH','MESSAGE','OPEN','OPEN_APP','OWN','PAY','PIN','PIN_IT','PLAN','PLAY','PURCHASE','RATE','READ','READ_MORE','RECOMMEND','RECORD','REDEEM','REGISTER',
	'REPLY','RESERVE','REVIEW','RSVP','SAVE','SAVE_OFFER','SEE_DEMO','SELL','SEND','SIGN_IN','SIGN_UP','START','STOP','SUBSCRIBE','TAKE_QUIZ','TAKE_TEST','TRY_IT',
	'UPVOTE','USE','VIEW','VIEW_ITEM','VIEW_MENU','VIEW_PROFILE','VISIT','VOTE','WANT','WANT_TO_SEE','WANT_TO_SEE_IT','WATCH','WATCH_TRAILER','WISH','WRITE',
	);
	
	foreach ($callToActionArray as $callToAction) {
		$sel = '';
		if(!empty($options['call_to_action']) && $options['call_to_action'] == $callToAction) {
			$sel = "selected='selected'";
		} 
		echo "<option ".$sel." value='".$callToAction."'>".$callToAction."</option>";
	}
?>	

                                    </select>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="margin:5px 0;">
                        <p style="margin:0;margin-left:10px;font-style:italic;font-size:11px;">
                            Choose Call To Action button. Click <a href='https://developers.google.com/+/features/call-to-action-labels'>here</a> for description.
                        </p>
                    </td>
                </tr>

				<tr valign="top">
                    <td style="padding:5px 0;">
                        <label style="padding:10px;font-weight:bold;">
                            Button Visibility
                        </label>
                    </td>
                    <td style="padding:5px 0;margin-left:5px;">
                        <table>
                            <tr>
                                <td style="padding:0px;margin:0px;">
                                    <select id ='button_visibility' name="wpipp_options[button_visibility]">
									<option value="all-pages" <?php if(!empty($options['button_visibility']) && $options['button_visibility'] == 'all-pages') echo "selected='selected'";?>>All Pages</option>
                                    <option value="home-page" <?php if(!empty($options['button_visibility']) && $options['button_visibility'] == 'home-page') echo "selected='selected'";?>>Only Home Page</option>
									<option value="all-posts-pages" <?php if(!empty($options['button_visibility']) && $options['button_visibility'] == 'all-posts-pages') echo "selected='selected'";?>>Individual Posts & Pages</option>
									</select>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="margin:5px 0;">
                        <p style="margin:0;margin-left:10px;font-style:italic;font-size:11px;">
                           Choose visibility for Button
                        </p>
                    </td>
                </tr>

                <tr valign="top">
                    <td style="padding:5px 0;">
                        <label style="padding:10px;font-weight:bold;">
                            Button Label for Home Page
                        </label>
                    </td>
                    <td style="padding:5px 0;margin-left:5px;">
                        <table>
                            <tr>
                                <td style="padding:0px;margin:0px;">
                                    <input id='button_label_hp' style="width: 220px;" type="text" size="57" name="wpipp_options[button_label_hp]" value="<?php if (!empty($options['button_label_hp'])) echo $options['button_label_hp']; else echo 'Share' ?>" />
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="margin:5px 0;">
                        <p style="margin:0;margin-left:10px;font-style:italic;font-size:11px;">
                           Enter label on Button for Home Page
                        </p>
                    </td>
                </tr>

				<tr valign="top">
                    <td style="padding:5px 0;">
                        <label style="padding:10px;font-weight:bold;">
                            Button Label for Posts & Pages
                        </label>
                    </td>
                    <td style="padding:5px 0;margin-left:5px;">
                        <table>
                            <tr>
                                <td style="padding:0px;margin:0px;">
                                    <input id='button_label_pp' style="width: 220px;" type="text" size="57" name="wpipp_options[button_label_pp]" value="<?php if (!empty($options['button_label_pp'])) echo $options['button_label_pp']; else echo 'Share' ?>" />
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="margin:5px 0;">
                        <p style="margin:0;margin-left:10px;font-style:italic;font-size:11px;">
                           Enter label on Button for Individual Posts & Pages
                        </p>
                    </td>
                </tr>


				<tr valign="top">
                    <td style="padding:5px 0;">
                        <label style="padding:10px;font-weight:bold;">
                            Button Position
                        </label>
                    </td>
                    <td style="padding:5px 0;margin-left:5px;">
                        <table>
                            <tr>
                                <td style="padding:0px;margin:0px;">
                                    <select id ='button_position' name="wpipp_options[button_position]">
									<option value="top-left" <?php if(!empty($options['button_position']) && $options['button_position'] == 'top-left') echo "selected='selected'";?>>Top Left</option>
                                    <option value="top-right" <?php if(!empty($options['button_position']) && $options['button_position'] == 'top-right') echo "selected='selected'";?>>Top Right</option>
									<option value="bottom-left" <?php if(!empty($options['button_position']) && $options['button_position'] == 'bottom-left') echo "selected='selected'";?>>Bottom Left</option>
									<option value="bottom-right" <?php if(!empty($options['button_position']) && $options['button_position'] == 'bottom-right') echo "selected='selected'";?>>Bottom Right</option>
									</select>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="margin:5px 0;">
                        <p style="margin:0;margin-left:10px;font-style:italic;font-size:11px;">
                           Choose position for Button
                        </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div style="margin-top:10px;">
                        </div></td>
                </tr>
                <tr valign="top" style="border-top:#dddddd 1px solid;">
                </tr>

            </table>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Settings') ?>" />
            </p>
        </form>
        <br/>
    </div>
    <?php
}


function wpipp_footerscript() {

    $options = get_option('wpipp_options');

    $status = !empty($options['status']) ? $options['status'] : 'enabled';
    $client_id = !empty($options['client_id']) ? $options['client_id'] : null;
    $call_to_action = !empty($options['call_to_action']) ? $options['call_to_action'] : 'READ_MORE';
    $button_label_hp = !empty($options['button_label_hp']) ? $options['button_label_hp'] : 'Share';
	$button_label_pp = !empty($options['button_label_pp']) ? $options['button_label_pp'] : 'Share';
	$position = !empty($options['button_position']) ? $options['button_position'] : 'top-left';
	$visibility = !empty($options['button_visibility']) ? $options['button_visibility'] : 'all-pages';
	
	$button_label = $button_label_pp;
	if (is_home() || is_front_page()) {
		$button_label = $button_label_hp;
	}
	
	$visibility_flag = false;
	
	if ($visibility == 'home-page') {
		if (is_home() || is_front_page()) {
			$visibility_flag = true;
		}
	}
	
	if ($visibility == 'all-posts-pages') {
		if (!(is_home() || is_front_page())) {
			$visibility_flag = true;
		}
	}
	
	if ($visibility == 'all-pages') {
		$visibility_flag = true;
	}
	
	if ($status != 'disabled' && !empty($client_id) && $visibility_flag) {
		$positionClass = "left:10px;top:100px;";
		if ($position == 'top-left') {
			$positionClass = "left:10px;top:100px;";
		} else if ($position == 'top-right') {
			$positionClass = "right:10px;top:100px;";
		} else if ($position == 'bottom-left') {
			$positionClass = "left:10px;bottom:100px;";
		} else if ($position == 'bottom-right') {
			$positionClass = "right:10px;bottom:100px;";
		}
		?>
		<!-- Place the tag where you want the button to render -->

		<button style='<?php echo $positionClass; ?>position:fixed;background:#CF3E2B;color:#fff;border:0px;border-radius:4px;padding: 4px 10px;font-family:georgia;font-size:20px;cursor:pointer;'
		  class="g-interactivepost"
		  data-contenturl="http://googleplus-one.co.uk/category/google-plus-widgets-apps/"
		  data-contentdeeplinkid="category/google-plus-widgets-apps"
		  data-clientid="<?php echo $client_id; ?>"
		  data-cookiepolicy="single_host_origin"
		  data-prefilltext="<?php the_title(); ?>"
		  data-calltoactionlabel="<?php echo $call_to_action; ?>"
		  data-calltoactionurl="http://googleplus-one.co.uk/category/google-plus-widgets-apps/"
		  data-calltoactiondeeplinkid="category/google-plus-widgets-apps">
		  <?php echo $button_label;?>
		</button>
		
		<script type="text/javascript">
		  (function() {
		   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		   po.src = 'https://apis.google.com/js/client:plusone.js';
		   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		 })();
		</script>
		<?
	}
}

register_uninstall_hook(__FILE__, 'wpipp_delete_plugin_options');
add_action('admin_init', 'wpipp_init');
add_action('admin_menu', 'wpipp_add_options_page');
add_filter('plugin_action_links', 'wpipp_plugin_action_links', 10, 2);
add_action('wp_footer', 'wpipp_footerscript', 10);

?>