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


/**
* Sets up the default arguments.
*/
function thrb_get_default_args() {

	$defaults = array(

		'post_type' 			=> 'thrb',
        'post_status' 			=> array( 'publish' ),
        'posts_per_page'		=> 4,
        'order'          		=> 'ASC',
        'orderby'        		=> 'rand',

        'reviewid'              => '',
        'random'                => true,
        'imagecurved'           => false,
        'showstars'             => true,
        'showdescription'       => true,
        'showauthorname'        => true,
        'showtitle'             => true,
        'limit'                 => 4,
        'before'                => '',
		'after'                 => ''
	);

	// return filter
	return apply_filters( 'thrb_default_args', $defaults );

}

/**
 * Get random Reviews and create a output
 *
 * @param [type] $args
 * @param [type] $id
 * @return void
 */
function thrb_get_random_review( $args, $id ){

    //Default Output
    $htmlout = '';

    // Merge the input arguments and the defaults.
    $args = wp_parse_args( $args, thrb_get_default_args() );
        
    // Extract the array to allow easy use of variables.
    extract( $args );

    // Query arguments.
	$query_args = array(
		'orderby'             => $args['orderby'],
		'post_type'           => 'thrb',
        'post_status'         => array( 'publish' ),
        'posts_per_page'      => $args['limit'],
        'order'               => $args['order'],
    );

    //Parse String Boolean
    if( $args['imagecurved'] === 'false' ){
        $args['imagecurved'] = false;
    }

    //Parse String Boolean
    if( $args['random'] === 'false' ){
        $args['random'] = false;
    }

    //Parse String Boolean
    if( $args['showstars'] === 'false' ){
        $args['showstars'] = false;
    }

    //Parse String Boolean
    if( $args['showdescription'] === 'false' ){
        $args['showdescription'] = false;
    }

    //Parse String Boolean
    if( $args['showauthorname'] === 'false' ){
        $args['showauthorname'] = false;
    }

    //Parse String Boolean
    if( $args['showtitle'] === 'false' ){
        $args['showtitle'] = false;
    }
    
    //Random Post
    if(!$args['random']){
        $query_args['orderby'] = 'date';
    }else{
        $query_args['orderby'] = 'rand';
    }
    
    //search single review
    if(!empty($args['reviewid'])){
        $query_args['p'] = $args['reviewid'];
    }

    // Get options
    $border_color = get_option( 'thrb_setting_border_color_hover' , '#237dd1');

    // WP Query Parameters
    $thrb_query = new WP_Query($query_args);
    $post_count = $thrb_query->post_count;

    if( $thrb_query->have_posts() ) { 
        
        //Buffer Start
        ob_start();

        //Get CSS
        thrb_getCssOutput( $post_count, $border_color, $id );

        //Output Buffer and Clen Buffer
        $o = ob_get_clean();

        //Output String
        $htmlout .= thrb_getOutputReviewsList( $id, $thrb_query, $args );
    }

    wp_reset_postdata(); // Reset WP Query
    return wp_kses_post( $args['before'] ) . $o . $htmlout . wp_kses_post( $args['after'] );

}


/**
 * Get HTMl Code
 *
 * @param [type] $thrb_query
 * @return void
 */
function thrb_getOutputReviewsList( $id, $thrb_query, $args ){
  
    $htmlout = '<!-- Start Triopsi Hosting Review List -->';
  
    if( $thrb_query->have_posts() ) { 
      
      //itteration
      $i=0;
  
      $htmlout .='<ul id="thrb-review-panel-bar-'.$id.'" class="thrb-review-panel">';
  
      //Outputt all Services
      foreach ($thrb_query->get_posts() as $review):
  
        if($args['imagecurved']){
          $imagecssextra = "thrb-curvedimg";
        }else{
          $imagecssextra = "";
        }
  
        //itteration high
        $i++;
  
        $htmlout .='<!--'.$i.'-->';
  
        //Get the title
        $title_review = $review->post_title;  
  
        //Get the image
        $review_image = thrb_get_logo_image($review->ID, 'thrb-thumbnail');
  
        //get post meta data
        $reviewauthor = get_post_meta( $review->ID, '_thrb_review_details_author_name', true);
        $reviewrating = (float)get_post_meta( $review->ID, '_thrb_review_details_rating', true);
        
        $reviewauthor = (empty($reviewauthor))?'':$reviewauthor;
        $reviewrating = (empty($reviewrating))?0:$reviewrating;
  
        //Default url
        $htmlurl='';
  
        //Start List
        $htmlout .='<li id="thrb-review-id-'.$review->ID.'-'.$id.'" class="thrb-review thrb-review-'.$i.'">';
        $htmlout .='<div class="thrb-box-single-review">
                      <div class="thrb-single-review">';

        if(!empty($review_image)){
          $htmlout .= ' <div class="thrb-box-image '.$imagecssextra .'"> <img class="thrb-image" src="'.$review_image.'"></div>';
        }    

        if( $args['showauthorname'] ){
            $htmlout .='  <h3 class="thrb-author-name">' . esc_html($reviewauthor) . '</h3>';
        } 

        if( $args['showstars'] ){
            $htmlout .= ' <div class="thrb-star-rating">';
            $htmlout .='    <span class="thrb-precent-star-rating" style="width:' . thrb_calc_star_rating( $reviewrating ) . '%">' . thrb_calc_star_rating( $reviewrating ) . '%</span>';
            $htmlout .='   </div>';
        }

        if( $args['showtitle'] ){
            $htmlout .='  <h4 class="thrb-title">' . esc_html($review->post_title) . '</h4>';
        }

        if( $args['showdescription'] ){
            $htmlout .='  <p class="thrb-author-desc">"' . esc_html($review->post_content) . '"</p>';
        }

        $htmlout .='  </div>
                    </div>';
        $htmlout .='</li>';
      endforeach;
  
      $htmlout .='</ul><!-- END UL-->';
    }
    $htmlout .= '<!-- End Triopsi Hosting Review List  -->';
    return $htmlout; 
}

/**
 * Get CSS 
 *
 * @param [type] $post_count
 * @param [type] $border_color
 * @return void
 */
function thrb_getCssOutput( $post_count, $border_color, $id){
?>
<style>
        ul#thrb-review-panel-bar-<?php echo $id; ?> li {
            width: <?php echo round((100/$post_count),2); ?>%;
        }   
        .thrb-box-single-review:hover {
            border-bottom-color: <?php echo esc_html($border_color); ?>;
        }
    </style>
<?php
}

