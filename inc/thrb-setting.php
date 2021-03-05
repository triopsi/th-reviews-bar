<?php
/**
 * Author: triopsi
 * Author URI: http://wiki.profoxi.de
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0
 *
 * Thrb is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * thrb is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with thrb. If not, see https://www.gnu.org/licenses/gpl-3.0.
 *
 * @package thrb
 **/

/**
 * Init setting setup
 *
 * @return void
 */
function thrb_settings_init() {

	// register new settings.
	register_setting( 'thrb', 'thrb_settings_cdn_awesome' );
	register_setting( 'thrb', 'thrb_setting_border_color_hover' );

	// Font Colors.
	add_settings_section(
		'thrb_settings_section_font_color',
		__( 'Color shema', 'thrb' ),
		'thrb_settings_section_color',
		'thrb'
	);

	// Border Hover Color Field.
	add_settings_field(
		'thrb_settings_hover_color',
		__( 'Choose a color for bottom border:', 'thrb' ),
		'thrb_settings_field_hover_color_cb',
		'thrb',
		'thrb_settings_section_font_color'
	);

	// Font Awesome CDN.
	add_settings_section(
		'thrb_settings_section_font_cdn',
		'Font Awesome CDN',
		'thrb_settings_cdn_section_cb',
		'thrb'
	);

	// Social Media Style CDN Field.
	add_settings_field(
		'thrb_settings_cdn_awesome',
		__( 'Use Font Awesome CDN?', 'thrb' ),
		'thrb_settings_field_cdn_cb',
		'thrb',
		'thrb_settings_section_font_cdn'
	);
}

/**
 * register thrb_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'thrb_settings_init' );

/**
 * section Color Description
 */
function thrb_settings_section_color() {
	esc_html_e( 'This color will use for the review section', 'thrb' );
}


/**
 * section CDN Description
 */
function thrb_settings_cdn_section_cb() {
	esc_html_e( 'Want to use the CDN for Font Awesome Icons?', 'thrb' );
}

/**
 * section Style Description
 */
function thrb_settings_section_cb() {
	/* translators: %s is replaced with the link */
	printf(
		__( 'By default the plugin used and needed the font awesome icon libary(%s).', 'thrb' ),
		'<a target="_blank" href="https://fontawesome.com/">more infos</a>'
	);
}

/**
 * Hover Color CP
 *
 * @param array $args
 * @return void
 */
function thrb_settings_field_hover_color_cb( array $args ) {
	$old_setting_value = ( ! empty( get_option( 'thrb_setting_border_color_hover' ) ) ? get_option( 'thrb_setting_border_color_hover' ) : '#237dd1' );
	?>
	<input type="text" id="thrb-hover-color-field" class="thrb-hover-color-field" name="thrb_setting_border_color_hover" value="<?php echo esc_attr( $old_setting_value ); ?>">
	<?php
}


/**
 * Social Media CDN
 *
 * @param array $args
 * @return void
 */
function thrb_settings_field_cdn_cb( array $args ) {
	$old_setting_value = ( ! empty( get_option( 'thrb_settings_cdn_awesome' ) ) ? get_option( 'thrb_settings_cdn_awesome' ) : 'yes' );
	?>
	<fieldset>
		<input type="radio" id="field_cdn_yes" class="thrb-field-setting-cdn" name="thrb_settings_cdn_awesome" value="yes" <?php echo ( $old_setting_value === 'yes' ? 'checked' : '' ); ?>>
		<label for="field_cdn_yes"> <?php echo __( 'yes', 'thrb' ); ?></label> 
		<input type="radio" id="field_cdn_no" class="thrb-field-setting-cdn" name="thrb_settings_cdn_awesome" value="no" <?php echo ( $old_setting_value === 'no' ? 'checked' : '' ); ?>>
		<label for="field_cdn_no"> <?php echo __( 'no', 'thrb' ); ?></label> 
	</fielset>
	<?php
}


/**
 * top level menu
 */
function thrb_option_menue() {

	add_options_page(
		__( 'TH Reviews Options', 'thrb' ),
		__( 'TH Reviews Options', 'thrb' ),
		'manage_options',
		'thrb',
		'thrb_options_page_html'
	);
}

/**
* register our thrb_options_page to the admin_menu action hook
*/
add_action( 'admin_menu', 'thrb_option_menue' );

/**
 * Add hrlp page function
 *
 * @return void
 */
function thrb_options_page_html() {
	// check user capabilities.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		<form action="options.php" method="post">
			<?php
				// output security fields for the registered setting "thrb".
				settings_fields( 'thrb' );

				// output setting sections and their fields.
				// (sections are registered for "thrb", each field is registered to a specific section).
				do_settings_sections( 'thrb' );

				// output save settings button.
				submit_button( __( 'Save Settings', 'thrb' ) );
			?>
		</form>
		<div id="post-body-content">
			<div id="thrb-admin-page" class="meta-box-sortabless">
				<div id="thrb-shortcode" class="postbox">
					<div class="inside">
						<h3 class="wp-pic-title"><?php _e( 'Supports', 'thrb' ); ?></h3>
						<div class="thrb-wrap-option-page">
							<a href="https://paypal.me/triopsi" target="_blank" class="button button-secondary">❤️ <?php _e( 'Donate', 'thrb' ); ?></a> 
							<a href="edit.php?post_type=thrb&page=thrb_help" target="_self" class="button button-secondary">ℹ️ <?php _e( 'Help', 'thrb' ); ?></a> 
						</div>
					 </div>
				</div>
			</div>
		<?php if ( WP_DEBUG ) { ?>
			<div class="debug-info">
				<h3><?php _e( 'Debug information', 'thrb' ); ?></h3>
				<p><?php _e( 'You are seeing this because your WP_DEBUG variable is set to true.', 'thrb' ); ?></p>
				<pre>thrb_plugin_version: <?php print_r( get_option( 'thrb_plugin_version' ) ); ?></pre>
				<pre>thrb_settings_cdn_awesome: <?php print_r( get_option( 'thrb_settings_cdn_awesome' ) ); ?></pre>
				<pre>thrb_setting_border_color_hover: <?php print_r( get_option( 'thrb_setting_border_color_hover' ) ); ?></pre>
				<pre>All Reviews: <?php print_r( thrb_show_all_posts() ); ?></pre>
			</div><!-- /.debug-info -->
		<?php } ?>
	</div>
	<?php
}

/**
 * Find all partners
 */
function thrb_show_all_posts() {

	$thrb_query = new WP_Query(
		array(
			'post_type'      => 'thrb',
			'post_status'    => array( 'any' ),
			'posts_per_page' => -1,
			'order'          => 'asc',
			'orderby'        => 'date',
		)
	);

	$post_type_arg   = array(
		'post_type'      => 'thrb',
		'posts_per_page' => -1,
	);
	$getpostsentries = get_posts( $post_type_arg );

	return $getpostsentries;
}
