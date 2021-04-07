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
 * @version 1.0.0
 **/

/**
 * Version Check
 *
 * @return void
 */
function thrb_check_version() {
	if ( thrb_VERSION !== get_option( 'thrb_plugin_version' ) ) {
		thrb_activation();
	}
}

// Loaded Plugin.
add_action( 'plugins_loaded', 'thrb_check_version' );

// Add Admin panel.
add_action( 'admin_enqueue_scripts', 'add_admin_thrb_style_js' );

/**
 * Undocumented function
 *
 * @return void
 */
function add_admin_thrb_style_js() {

	// Gets the post type.
	global $post_type;

	if ( 'thrb' === $post_type ) {

		// Remove Attachment/Media Button.
		remove_action( 'media_buttons', 'media_buttons' );

		// Add all JS, CSS and settings for the media js.
		wp_enqueue_media();

		// JS for metaboxes.
		wp_enqueue_script( 'thrb-logic-form', plugins_url( '../assets/js/logic-form.js', __FILE__ ), array(), '1.0.0', true );

		// Font Awesome.
		wp_enqueue_style( 'thrb-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.css', array(), '1.0.0', 'all' );

		// CSS for metaboxes.
		wp_enqueue_style( 'thrb-admin-styles', plugins_url( '../assets/css/front-admin.css', __FILE__ ), array(), '1.0.0', 'all' );

	} else {

		// WP color picker Style and scripts.
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		// JS for metaboxes.
		wp_enqueue_script( 'thrb-admin-form', plugins_url( '../assets/js/admin-form.js', __FILE__ ), array(), '1.0.0', true );

	}

}

/**
 * Update Version Number
 *
 * @return void
 */
function thrb_activation() {
	update_option( 'thrb_plugin_version', thrb_VERSION );
}

