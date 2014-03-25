<?php
/**
 * @package WordPress
 * @subpackage astrid2013 Theme
 */


/*-----------------------------------------------------------------------------------*/
/* REGISTER Admin */
/*-----------------------------------------------------------------------------------*/
function astrid2013_theme_settings_init(){
	register_setting( 'astrid2013_theme_settings', 'astrid2013_theme_settings' );
}


// add js for admin
function astrid2013_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}
//add css for admin
function astrid2013_style() {
	wp_enqueue_style('thickbox');
}
function astrid2013_echo_scripts()
{
?>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {

// Media Uploader
window.formfield = '';

jQuery('.upload_image_button').live('click', function() {
	window.formfield = jQuery('.upload_field',jQuery(this).parent());
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	return false;
});

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html) {
	if (window.formfield) {
		imgurl = jQuery('img',html).attr('src');
		window.formfield.val(imgurl);
		tb_remove();
	}
	else {
		window.original_send_to_editor(html);
	}
	window.formfield = '';
	window.imagefield = false;
}

});
//]]> 
</script>
<?php
}

if (isset($_GET['page']) && $_GET['page'] == 'theme-settings') {
	add_action('admin_print_scripts', 'astrid2013_scripts'); 
	add_action('admin_print_styles', 'astrid2013_style');
	add_action('admin_head', 'astrid2013_echo_scripts');
}


function astrid2013_add_settings_page() {
add_theme_page( __( 'Theme Settings', 'astrid2013' ), __( 'Theme Settings', 'astrid2013' ), 'manage_options', 'theme-settings', 'astrid2013_theme_settings_page');
}

add_action( 'admin_init', 'astrid2013_theme_settings_init' );
add_action( 'admin_menu', 'astrid2013_add_settings_page' );

function astrid2013_theme_settings_page() {
	
global $slider_effects;
?>


<?php 
/*-----------------------------------------------------------------------------------*/
/* START Admin */
/*-----------------------------------------------------------------------------------*/
?>

<div class="wrap">

<?php
// If the form has just been submitted, this shows the notification
if ( $_GET['settings-updated'] ) { ?>
<div id="message" class="updated fade -message"><p><?php _e('Options Saved','astrid2013'); ?></p></div>
<?php } ?>

<div id="icon-options-general" class="icon32"></div>
<h2><?php _e( ' Theme Settings', 'astrid2013' ) ?></h2>

<form method="post" action="options.php">

<?php settings_fields( 'astrid2013_theme_settings' ); ?>
<?php $options = get_option( 'astrid2013_theme_settings' ); ?>

<table class="form-table">  

<tr valign="top">
<th scope="row"><?php _e( 'Favicon', 'astrid2013' ); ?></th>
<td>
<input id="astrid2013_theme_settings[favicon]" class="regular-text" type="text" size="36" name="astrid2013_theme_settings[favicon]" value="<?php esc_attr_e( $options['favicon'] ); ?>" />
<br />
<label class="description abouttxtdescription" for="astrid2013_theme_settings[favicon]"><?php _e( 'Ladda upp eller skriv URLen f&ouml;r sajtens favicon.','astrid2013'); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Logo', 'astrid2013' ); ?></th>
<td>
<input id="astrid2013_theme_settings[upload_mainlogo]" class="regular-text upload_field" type="text" size="36" name="astrid2013_theme_settings[upload_mainlogo]" value="<?php esc_attr_e( $options['upload_mainlogo'] ); ?>" />
<input class="upload_image_button button-secondary" type="button" value="Upload Image" />
<br />
<label class="description abouttxtdescription" for="astrid2013_theme_settings[logo]"><?php _e( 'Ladda upp eller skriv URLen f&ouml;r sajtens logo.','astrid2013'); ?></label>
</td>
</tr>


<tr valign="top">
<th scope="row">Theme Credits</th>
<td><p>Based on Bootstrap 3 / wp-bootstrap. Theme code by  <a href="http://klickomaten.com">Tdude</a>, designed by <a href="http://astrid.se">Linnea</a>.<br />
</p>
</td>
</tr>

<tr valign="top">
<th scope="row">Theme License</th>
<td><p>GPL - Use and abuse. Of course any sort of credit or linking to us is very much appreciated.</p>
</td>
</tr>

</table>
<p class="submit-changes">
<input type="submit" class="button-primary" value="<?php _e( 'Save theme options', 'astrid2013' ); ?>" />
</p>
</form>
</div><!-- END wrap -->

<?php
}
//sanitize and validate
function astrid2013_options_validate( $input ) {
	global $select_options, $radio_options;
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

?>