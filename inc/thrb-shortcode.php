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

// Shortcode on the Page.
add_shortcode( 'thrb', 'thrb_sh' );

/**
 * Show the Shortcode in the post/site/content
 *
 * @param array $atts
 * @return void
 */
function thrb_sh( $atts ) {

	// Get shortcode attr
	$args = shortcode_atts( thrb_get_default_args(), $atts );

	// Retunr Output
	return thrb_get_random_review( $args, uniqid() );

}
