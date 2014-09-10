<?php
defined( 'ABSPATH' ) OR exit;
/**
 * @package whereabouts
 * @since 0.1.0
 */


/**
 * Register settings
 *
 * @since 0.1.0
 */

add_action( 'admin_init', 'whereabouts_register_settings' );

function whereabouts_register_settings() {
    // location data
    register_setting( 'whab_location_data', 'whab_location_data', 'whereabouts_location_validate' );
    // plugin settings
    register_setting( 'whab_settings', 'whab_settings', 'whereabouts_settings_validate' );
}


/**
 * Validate Whereabouts location
 *
 * @since 0.1.0
 */

function whereabouts_location_validate( $args ) {

    if( ! isset( $args['location_name'] ) OR empty( $args['location_name'] ) ) {
        // Add settings error if location field is empty
        add_settings_error( 'location_name', 'whereabouts_empt_location', 'Please enter a location.', $type = 'error' );
    } else {
        // Sanitize location name before saving
        $args['location_name'] = sanitize_text_field( $args['location_name'] );
    }

    // Sanitize time zone name before saving    
    $args['utc_difference'] = htmlentities( $args['utc_difference'], ENT_NOQUOTES, 'UTF-8' );

    // Sanitize time zone name before saving
    $args['timezone_name'] = sanitize_text_field( $args['timezone_name'] );
    
    // Sanitize geo before saving
    $args['geo'] = sanitize_text_field( $args['geo'] );

    return $args;

}


/**
 * Validate Whereabouts settings
 *
 * @since 0.1.0
 */

function whereabouts_settings_validate( $args ) {

    // use-google can either be true or false... make sure it is either one of them
    if ( ! empty( $args['use_google'] ) ) {
        if ( $args['use_google'] != true ) {
            $args['use_google'] = false;
        }
    }
    
    // Check if the chosen language is allowed...
    if ( ! empty( $args['language'] ) ) {
        
        $allowed_languages = array( 'ar', 'eu', 'bg', 'bn', 'ca', 'cs', 'da', 'de', 'el', 'en', 'en-AU', 'en-GB', 'es', 'eu', 'fa', 'fi', 'fil', 'fr', 'gl', 'gu', 'hi', 'hr', 'hu', 'id', 'it', 'iw', 'ja', 'kn', 'ko', 'lt', 'lv', 'ml', 'mr', 'nl', 'nn', 'no', 'or', 'pl', 'pt', 'pt-BR', 'pt-PT', 'rm', 'ro', 'ru', 'sk', 'sl', 'sr', 'sv', 'tl', 'ta', 'te', 'th', 'tr', 'uk', 'vi', 'zh-CN', 'zh-TW' );
        
        if ( ! in_array( $args['language'] , $allowed_languages ) ) {
            add_settings_error( 'language', 'whab-language', __( 'This language is not supported.', 'whereabouts' ), $type = 'error' );
            $args['language'] = '';
        }
    }

    // Check if the Google API key has been validated
    if ( ! empty( $args['google-maps-api-key'] ) ) {

        if ( ! isset( $args['key-validation'] ) OR $args['key-validation'] != true ) {
            add_settings_error( 'api-key', 'whab-api-key', __( 'The key you provided is not valid.', 'whereabouts' ), $type = 'error' );
            unset( $args['google-maps-api-key'] );
        } else {
            $args['google-maps-api-key'] = sanitize_text_field( $args['google-maps-api-key'] );
        }

        // Don't need to save that
        unset( $args['key-validation'] );                         
    }

    return $args;

}
?>