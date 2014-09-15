<?php
defined( 'ABSPATH' ) OR exit;
/* 
 * @package Whereabouts
 * @since 0.1.0
 */


/** 
 * Tell WordPress that there is a new widget in town!
 *
 * @since 0.1.0
 */

class Whereabouts extends WP_Widget {

    // Instantiate parent object
	function Whereabouts() {
		parent::__construct( 'whereabouts_widget', 'Whereabouts', array( 'description' => __( 'Shows current location and timezone.', 'whereabouts' ) ) );
	}

    // Front end display of widget
	function widget( $args, $instance ) {

        $location = get_option( 'whab_location_data' );
        
        // Only display widget if location is set
        if ( ! empty( $location['location_name'] ) ) {

            $title = apply_filters( 'widget_title', $instance['title'] );
            $link_location = apply_filters( 'widget_title', $instance['link_location'] );
            $show_tz = apply_filters( 'widget_title', $instance['show_tz'] );
            $time_format = apply_filters( 'widget_title', $instance['time_format'] );

            echo $args['before_widget'];
            if ( ! empty( $title ) ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            echo whereabouts_display_widget( $link_location, $show_tz, $time_format );
            echo $args['after_widget'];

        }
	}

	// Save widget options    
	function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['link_location'] = ( ! empty( $new_instance['link_location'] ) ) ? strip_tags( $new_instance['link_location'] ) : '';
        $instance['show_tz'] = ( ! empty( $new_instance['show_tz'] ) ) ? strip_tags( $new_instance['show_tz'] ) : '';
        $instance['time_format'] = ( ! empty( $new_instance['time_format'] ) ) ? strip_tags( $new_instance['time_format'] ) : 'H:i';
        return $instance;

	}

    // Output admin widget options form
	function form( $instance ) {

        if ( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        }
        else {
            $title = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'whereabouts' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'link_location' ); ?>" name="<?php echo $this->get_field_name( 'link_location' ); ?>" type="checkbox" value="1"<?php if ( isset( $instance['link_location'] ) AND $instance['link_location'] == true ) { echo 'checked="checked"'; } ?> />
            <label for="<?php echo $this->get_field_id( 'link_location' ); ?>"><?php _e( 'Link location to Google Maps', 'whereabouts' ); ?></label> 
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_tz' ); ?>" name="<?php echo $this->get_field_name( 'show_tz' ); ?>" type="checkbox" value="1"<?php if ( isset( $instance['show_tz'] ) AND $instance['show_tz'] == true ) { echo 'checked="checked"'; } ?> />
            <label for="<?php echo $this->get_field_id( 'show_tz' ); ?>"><?php _e( 'Show time zone name', 'whereabouts' ); ?></label> 
        </p>
        <p>
        	<strong><?php _e( 'Time Format', 'whereabouts' ); ?></strong><br />
            <span class="whab-pair"><input type="radio" name="<?php echo $this->get_field_name( 'time_format' ); ?>" id="<?php echo $this->get_field_id( 'time_format_H_i' ); ?>" value="H:i"<?php if ( ! isset( $instance['time_format'] ) OR ( isset( $instance['time_format'] ) AND $instance['time_format'] == 'H:i' ) ) { echo 'checked="checked"'; } ?> /> <label for="<?php echo $this->get_field_id( 'time_format_H_i' ); ?>"><?php echo date( 'H:i' ); ?></label></span>
            <span class="whab-pair"><input type="radio" name="<?php echo $this->get_field_name( 'time_format' ); ?>" id="<?php echo $this->get_field_id( 'time_format_g_i_a' ); ?>" value="g:i a"<?php if ( isset( $instance['time_format'] ) AND $instance['time_format'] == 'g:i a' ) { echo 'checked="checked"'; } ?> /> <label for="<?php echo $this->get_field_id( 'time_format_g_i_a' ); ?>"><?php echo date( 'g:i a' ); ?></label></span>
        	<span class="whab-pair"><input type="radio" name="<?php echo $this->get_field_name( 'time_format' ); ?>" id="<?php echo $this->get_field_id( 'time_format_g_i_A' ); ?>" value="g:i A"<?php if ( isset( $instance['time_format'] ) AND $instance['time_format'] == 'g:i A' ) { echo 'checked="checked"'; } ?> /> <label for="<?php echo $this->get_field_id( 'time_format_g_i_A' ); ?>"><?php echo date( 'g:i A' ); ?></label></span>
        </p>
        <?php
	}
}


/** 
 * Register the widget
 *
 * @since 0.1.0
 */

add_action( 'widgets_init', 'whereabouts_register_widgets' );

function whereabouts_register_widgets() {
	register_widget( 'Whereabouts' );
}

?>