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

// if uninstall.php is not called by WordPress, die.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Delete plugin options.
$option_version = 'thrb_plugin_version';

// delete options
delete_option( 'thrb_settings_cdn_awesome' );
delete_option( 'thrb_setting_border_color_hover' );
delete_option( 'thrb_plugin_version' );

// Delete metadata and posts.
$post_type_arg   = array(
	'post_type'      => 'thrb',
	'posts_per_page' => -1,
);
$getpostsentries = get_posts( $post_type_arg );
foreach ( $getpostsentries as $delpost ) {
	wp_delete_post( $delpost->ID, true );
}

