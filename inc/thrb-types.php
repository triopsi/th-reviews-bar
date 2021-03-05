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

// Registers the teams post type.
add_action( 'init', 'register_thrb_type' );

// Register new image size.
add_action( 'init', 'thrb_register_image_size' );

/**
 * Function about the ini of the Plugin
 *
 * @return void
 */
function register_thrb_type() {

// Defines labels.
	$labels = array(
		'name'               => __( 'TH Review', 'thrb' ),
		'singular_name'      => __( 'Review', 'thrb' ),
		'menu_name'          => __( 'TH Reviews', 'thrb' ),
		'name_admin_bar'     => __( 'TH Reviews', 'thrb' ),
		'add_new'            => __( 'Add New Review', 'thrb' ),
		'add_new_item'       => __( 'Add New Review', 'thrb' ),
		'new_item'           => __( 'New Review', 'thrb' ),
		'edit_item'          => __( 'Edit Review', 'thrb' ),
		'view_item'          => __( 'View Review', 'thrb' ),
		'all_items'          => __( 'All Reviews', 'thrb' ),
		'search_items'       => __( 'Search Review', 'thrb' ),
		'not_found'          => __( 'No Reviews found.', 'thrb' ),
		'not_found_in_trash' => __( 'No Reviews found in Trash.', 'thrb' ),
	);

	// Defines permissions.
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_admin_bar'  => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'thumbnail', 'editor' ),
		'menu_icon'          => 'dashicons-star-filled',
		'query_var'          => true,
		'rewrite'            => false,
	);

	// Registers post type.
	register_post_type( 'thrb', $args );

}


// Add update messages.
add_filter( 'post_updated_messages', 'thrb_updated_messages' );

/**
 * Update post message functions
 *
 * @param [type] $messages
 * @return void
 */
function thrb_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );
	$messages['thrb'] = array(
		1  => __( 'Review updated.', 'thrb' ),
		4  => __( 'Review updated.', 'thrb' ),
		6  => __( 'Review published.', 'thrb' ),
		7  => __( 'Reviews saved.', 'thrb' ),
		10 => __( 'Reviews draft updated.', 'thrb' ),
	);

	return $messages;

}

/**
 * Shortcodestyle function
 *
 * @param [type] $column
 * @param [type] $post_id
 * @return void
 */
function thrb_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'thrb_shortcode':
			global $post;
			$slug      = '';
			$slug      = $post->ID;
			$shortcode = '<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value="[thrb reviewid=&quot;' . $slug . '&quot;]" class="large-text code"></span>';
			echo $shortcode;
			break;
	}
}

// Handles shortcode column display.
add_action( 'manage_thrb_posts_custom_column', 'thrb_custom_columns', 10, 2 );

/**
 * AdminCollumnBar function
 *
 * @param [type] $columns
 * @return void
 */
function add_thrb_columns( $columns ) {
	$columns['title'] = __( 'Review name', 'thrb' );
	unset( $columns['author'] );
	unset( $columns['date'] );
	return array_merge( $columns, array( 'thrb_shortcode' => 'Shortcode' ) );
}

// Adds the shortcode column in the postslistbar.
add_filter( 'manage_thrb_posts_columns', 'add_thrb_columns' );

/**
 * Register new image size.
 */
function thrb_register_image_size() {
	add_image_size( 'thrb-thumbnail', 450, 450, true );
}
