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
 * along with partner. If not, see https://www.gnu.org/licenses/gpl-3.0.
 *
 * @package thrb
 **/

// Add CSS Class to the front.
add_action( 'wp_enqueue_scripts', 'thrb_add_partner_front_css', 99 );
function thrb_add_partner_front_css() {
	wp_enqueue_style( 'thrb-css', plugins_url( '../assets/css/front-style.css', __FILE__ ) );
}

// Get option - Style Font Awesome.
$option_cdn = ( empty( get_option( 'thrb_settings_cdn_awesome' ) ) ? 'yes' : get_option( 'thrb_settings_cdn_awesome' ) );
if ( 'yes' === $option_cdn ) {
	add_action( 'wp_enqueue_scripts', 'add_thrb_cdn_font_awesome', 99 );
}

/**
 * Calc function star
 *
 * @param integer $rate
 * @return void
 */
function thrb_calc_star_rating( $rate ) {
	if ( $rate > 5 ) {
		return 5;
	}
	return ( ( 100 / 5 ) * $rate );
}

/**
 * Function to get post featured image
 */
function thrb_get_logo_image( $post_id = '', $size = 'thrb-thumbnail' ) {
	$imageurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
	if ( ! empty( $imageurl ) ) {
		$imageurl = isset( $imageurl[0] ) ? $imageurl[0] : '';
	}
	return $imageurl;
}


/**
 * CDN Function FOnt Awesome include
 */
function add_thrb_cdn_font_awesome() {
	wp_enqueue_style( 'thrb-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.css', __FILE__ );
}
