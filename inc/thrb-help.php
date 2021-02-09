<?php
/**
* Author: triopsi
* Author URI: http://wiki.profoxi.de
* License: GPL3
* License URI: https://www.gnu.org/licenses/gpl-3.0
*
* thrb is free software: you can redistribute it and/or modify
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
**/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Add Menue
add_action('admin_menu', 'thrb_register_help_page');

function thrb_register_help_page() {
    add_submenu_page( 'edit.php?post_type=thrb',
     __('How It Works', 'thrb'), 
     __('Help', 'thrb'), 
     'manage_options', 
     'thrb_help', 
     'thrb_help_page'
    );
}

function thrb_help_page() { ?>
	
	<style type="text/css">
		.thrb-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								
								<h3 class="hndle">
									<span><?php _e( 'How It Works - Display and shortcode', 'thrb' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Geeting Started with TH Review Bar', 'thrb'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step 1. Go to "All Reviews --> Add New Review"', 'thrb'); ?></li>
														<li><?php _e('Step 2. Add Review title, a Review image under the featured image section and rating the review.', 'thrb'); ?></li>
														<li><?php _e('Step 3a. Copy-paste the shortcode <span class="thrb-shortcode-preview">[thrb]</span> anywhere in your post or site for show a list of reviews', 'thrb'); ?></li>
														<li><b><?php _e('or','thrb') ?></b></li>
														<li><?php _e('Step 3b. Copy-paste the shortcode <span class="thrb-shortcode-preview">[thrb reviewid="&lt;id&gt;"]</span> anywhere in your post or site for show a single review', 'thrb'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'thrb'); ?>:</label>
												</th>
												<td>
													<span class="thrb-shortcode-preview">[thrb]</span> – <?php _e('Default shortcode. Show reviews in a list', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">[thrb reviewid="&lt;id&gt;"]</span> – <?php _e('show a single review', 'thrb'); ?> <br />
												</td>
											</tr>			
											
											<tr>
												<th>
													<label><?php _e('All Shortcodes parameters', 'thrb'); ?>:</label>
												</th>
												<td>
													<span class="thrb-shortcode-preview">random="true"</span> – <?php _e('Show random reviews instead of sorted by date', 'thrb'); ?> <br />													
													<span class="thrb-shortcode-preview">imagecurved="true"</span> – <?php _e('Images have a round radios', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">order="asc"</span> – <?php _e('sort the Review in ascending or descending order. Value=asc or desc', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">showstars="true"</span> – <?php _e('Show stars on review', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">showtitle="true"</span> – <?php _e('Show the title of the review', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">showauthorname="true"</span> – <?php _e('Show author name on review', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">showdescription="true"</span> – <?php _e('Show the descriptions of review', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">limit="4"</span> – <?php _e('Number of reviews to show', 'thrb'); ?>. <?php _e('-1 to show all reviews.', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">before=""</span> – <?php _e('HTML or text before the random review', 'thrb'); ?> <br />
													<span class="thrb-shortcode-preview">after=""</span> – <?php _e('HTML or text after the random review ', 'thrb'); ?> <br /><br />
													<?php _e('e.g.', 'thrb'); ?>
													<span class="thrb-shortcode-preview">[thrb limit="-1" showtitle="false" imagecurved="true" showstars="false"]</span>
												
												</td>
											</tr>	
											<tr>
												<th>
													<label><?php _e('Widget', 'thrb'); ?>:</label>
												</th>
												<td><p>
														<?php _e('Use the widget to insert a list of reviews in your page or post.', 'thrb'); ?> <br />
														<img title="widget" src="<?php echo plugins_url('../assets/img/screenshot-4.png', __FILE__); ?>">
													</p>
												</td>
											</tr>		

											<tr>
												<th>
													<label><?php _e('Need Support?', 'thrb'); ?></label>
												</th>
												<td>
													<p><?php _e('Check plugin document for shortcode parameters.', 'thrb'); ?></p> <br/>
													<a class="button button-primary" href="http://wiki.profoxi.de" target="_blank"><?php _e('Documentation', 'thrb'); ?></a>									
													<a class="button button-secondary" href="http://paypal.me/triopsi" target="_blank">❤️ <?php _e('Donate', 'thrb'); ?></a>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('Used libraries', 'thrb'); ?></label>
												</th>
												<td>
													<p>Font Awesome v5.15.2</p> <br/>
													<a class="button button-secondary" href="https://fontawesome.com/" target="_blank">https://fontawesome.com/</a>									
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }