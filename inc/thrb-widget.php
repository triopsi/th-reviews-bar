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

class thrbslidepanel_widget extends WP_Widget {

    function __construct(){
        parent::__construct(
            // Base ID of your widget
            'thrbpanelwidget',
            // Widget name will appear in UI
            __('TH Review Panel', 'thrb'),
            // Widget description
            array(
            'description' => __('Widget for the Plugin TH Reviews Bar','thrb')
        ));
    }

    // Creating widget front-end
    public function widget( $args, $instance ){

        //extract the args
        extract( $args );

		// Get the random posts.
		$random = thrb_get_random_review( $instance, uniqid() );

        //print before scripte and text
        echo $before_widget;

        // Get the random posts query.
		echo $random;

        //print after widget scripts and text
        echo $after_widget;
    }

    // Widget Backend
    public function form( $instance ){

        // Merge the user-selected arguments with the defaults.
        $instance = wp_parse_args( ( array ) $instance, thrb_get_default_args() );

        // Extract the array to allow easy use of variables.
        extract( $instance );

        // Widget admin form
        ?>
        <div style="margin-bottom:10px;">
            <p>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'imagecurved' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'imagecurved' ) ); ?>" type="checkbox" <?php checked( $instance[ 'imagecurved' ] ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'imagecurved' ) ); ?>"><?php _e('Images have a round radios', 'thrb'); ?></label>
            </p>

            <p>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'random' ) ); ?>" type="checkbox" <?php checked( $instance[ 'random' ] ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>"><?php _e('Show random reviews instead of sorted by date', 'thrb'); ?></label>
            </p>

            <p id="<?php echo esc_attr( $this->get_field_id( 'orderfield' ) ); ?>">
				<label for="<?php echo $this->get_field_id( 'order' ); ?>">
					<?php _e( 'Sorted by', 'thrb' ); ?>
				</label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" style="width:100%;">
                        <option value="ASC" <?php selected( $instance['order'], 'ASC' ); ?>>
                            ASC
                        </option>
                        <option value="DESC" <?php selected( $instance['order'], 'DESC' ); ?>>
                            DESC
                        </option>
                </select>
                <small>ASC: <?php _e( 'ascending order from newest to oldest date', 'thrb' ); ?></small><br>
                <small>DESC: <?php _e( 'descending order from oldest to newest date', 'thrb' ); ?></small>
			</p>

            <p>
				<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
					<?php _e( 'Number of reviews to show', 'thrb' ); ?>
				</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="-1" value="<?php echo (int) $instance['limit']; ?>" />
				<small>-1 <?php _e( 'to show all reviews.', 'thrb' ); ?></small>
            </p>

            <p>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'showauthorname' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showauthorname' ) ); ?>" type="checkbox" <?php checked( $instance[ 'showauthorname' ] ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'showauthorname' ) ); ?>"><?php _e('Show author name on review', 'thrb'); ?></label>
            </p>

            <p>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'showstars' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showstars' ) ); ?>" type="checkbox" <?php checked( $instance[ 'showstars' ] ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'showstars' ) ); ?>"><?php _e('Show stars on review', 'thrb'); ?></label>
            </p>

            <p>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'showtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showtitle' ) ); ?>" type="checkbox" <?php checked( $instance[ 'showtitle' ] ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'showtitle' ) ); ?>"><?php _e('Show the title of the review', 'thrb'); ?></label>
            </p>

            <p>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'showdescription' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showdescription' ) ); ?>" type="checkbox" <?php checked( $instance[ 'showdescription' ] ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'showdescription' ) ); ?>"><?php _e('Show the descriptions of review', 'thrb'); ?></label>
            </p>

            <p>
				<label for="<?php echo $this->get_field_id( 'before' ); ?>">
					<?php _e( 'HTML or text before the random review', 'thrb' );?>
				</label>
				<textarea class="widefat" id="<?php echo $this->get_field_id( 'before' ); ?>" name="<?php echo $this->get_field_name( 'before' ); ?>" rows="5"><?php echo htmlspecialchars( stripslashes( $instance['before'] ) ); ?></textarea>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'after' ); ?>">
					<?php _e( 'HTML or text after the random review', 'thrb' );?>
				</label>
				<textarea class="widefat" id="<?php echo $this->get_field_id( 'after' ); ?>" name="<?php echo $this->get_field_name( 'after' ); ?>" rows="5"><?php echo htmlspecialchars( stripslashes( $instance['after'] ) ); ?></textarea>
            </p> 
        </div>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ){

        $instance = $old_instance;

        $instance['imagecurved']        = isset( $new_instance['imagecurved'] ) ? (bool) $new_instance['imagecurved'] : false;
        $instance['random']             = isset( $new_instance['random'] ) ? (bool) $new_instance['random'] : false;
        $instance['before']             = wp_kses_post( $new_instance['before'] );
        $instance['after']              = wp_kses_post( $new_instance['after'] );
        $instance['limit']              = (int) $new_instance['limit'];
        $instance['order']              = ( !empty( $new_instance['order'] ) && $new_instance['order'] == 'ASC' ) ? 'ASC' : 'DESC';
        $instance['showauthorname']     = isset( $new_instance['showauthorname'] ) ? (bool) $new_instance['imagecurved'] : false;
        $instance['showstars']          = isset( $new_instance['showstars'] ) ? (bool) $new_instance['imagecurved'] : false;
        $instance['showtitle']          = isset( $new_instance['showtitle'] ) ? (bool) $new_instance['showtitle'] : false;
        $instance['showdescription']    = isset( $new_instance['showdescription'] ) ? (bool) $new_instance['imagecurved'] : false;
        
        return $instance;
    }

} // Class thrbslidepanel_widget ends here


// Register and load the widget
function thrb_load_widget(){
     register_widget('thrbslidepanel_widget');
}

add_action('widgets_init', 'thrb_load_widget');