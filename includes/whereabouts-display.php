<?php
defined( 'ABSPATH' ) OR exit;
/** 
 * @package Whereabouts
 * @since 0.1.0
 */


/**
 * Display location as a widget
 *
 * @since 0.1.0
 */

function whereabouts_display_widget( $link_location = false, $show_tz = false, $time_format = 'H:i' ) {

    $location = get_option( 'whab_location_data' );

    $output = '<dl class="whab-info">
                 <dt class="whab-label whab-label-location">' . __( 'Current Location:', 'whereabouts' ) . '</dt>
                 <dd class="whab-location">';
                 
    if ( $link_location == true ) {
        $output .= '<a title="Show location on Google Maps" href="https://www.google.co.uk/maps/place/' . str_replace( ' ', '', $location['location_name'] ) . '">';
    }
    $output .= $location['location_name'];
    if ( $link_location == true ) {    
        $output .= '</a>';
     }
    $output .= '</dd>
                 <dt class="whab-label whab-label-time">' . __( 'Local Time:', 'whereabouts' ) . '</dt>';

    $offset = $location['utc_difference'];
    $timezone_name = $location['timezone_name'];

    $output .= '<dd class="whab-time">';

    $current_time = time();
    $current_time = date( $time_format, $current_time + $offset );

    $output .= $current_time;

    if ( $show_tz == true AND !empty( $timezone_name ) ) {
        $output .= ' <span class="whab-timezone-name"> (' . $timezone_name . ')</span>';
    }

    $output .= '</dd></dl>';

    return $output;
}
?>