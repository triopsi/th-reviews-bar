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

// Hooks the metabox.
add_action( 'admin_init', 'thrb_add_details', 1 );

/**
 * Add Review details
 *
 * @return void
 */
function thrb_add_details() {
	add_meta_box(
		'thrb-partner-url',
		__( 'Review details', 'thrb' ),
		'thrb_add_review_details',
		'thrb',
		'normal'
	);
}

/**
 * Show the add/edit postpage in admin
 *
 * @return void
 */
function thrb_add_review_details( $post ) {

	// get post meta data.
	$reviewauthor = get_post_meta( $post->ID, '_thrb_review_details_author_name', true );
	$reviewrating = (float) get_post_meta( $post->ID, '_thrb_review_details_rating', true );

	$reviewauthor = ( empty( $reviewauthor ) ) ? '' : $reviewauthor;
	$reviewrating = ( empty( $reviewrating ) ) ? 0 : $reviewrating;

	// Hidden field.
	wp_nonce_field( 'thrb_meta_box_nonce', 'thrb_meta_box_nonce' );

	?>
	
	<div class="thrb_field">
		<div class="thrb_field_title">
			<?php esc_attr_e( 'Author name', 'thrb' ); ?>
		</div>
		<input class="thrb-field regular-text" id="reviewDetailsAuthorNameField" name="thrb_review_details_author_name" type="text" value="<?php echo esc_attr( $reviewauthor ); ?>" placeholder="<?php esc_attr_e( 'e.g. Max', 'thrb' ); ?>">
		<br>
		<div class="thrb_field_title">
			<?php esc_attr_e( 'Rating', 'thrb' ); ?>
		</div>
		<input class="thrb-field regular-text" id="reviewDetailsRatingField" name="thrb_review_details_rating" type="number" min="0" max="5" step="0.5" value="<?php echo esc_attr( $reviewrating ); ?>" >
		<br>
		<hr>
		<div class="review-container">
			<div class="review-star-rating"><span class="thrb-precent-star-rating" style="width:<?php echo thrb_calc_star_rating( $reviewrating ); ?>%"><?php echo thrb_calc_star_rating( $reviewrating ); ?>%</span></div>
		</div>
	</div>

	<?php
}

/**
 * Post Data Form
 */
add_action( 'save_post', 'thrb_save_meta_box_data' );

function thrb_save_meta_box_data( $post_id ) {

	if ( ! isset( $_POST['thrb_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['thrb_meta_box_nonce'], 'thrb_meta_box_nonce' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'thrb' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	// Check Post.
	if ( empty( $_POST['thrb_review_details_author_name'] ) || empty( $_POST['thrb_review_details_rating'] ) ) {
		return;
	}

	// Author name.
	$thrb_review_details_author_name = stripslashes( strip_tags( sanitize_text_field( $_POST['thrb_review_details_author_name'] ) ) );
	update_post_meta( $post_id, '_thrb_review_details_author_name', $thrb_review_details_author_name );

	// Rating number.
	$thrb_review_details_rating = stripslashes( strip_tags( sanitize_text_field( $_POST['thrb_review_details_rating'] ) ) );
	if ( $thrb_review_details_rating > 5 ) {
		$thrb_review_details_rating = 5;
	}
	update_post_meta( $post_id, '_thrb_review_details_rating', $thrb_review_details_rating );
}
