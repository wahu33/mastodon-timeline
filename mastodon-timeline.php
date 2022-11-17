<?php
/**
* Plugin Name: Mastadon Timeline
* Plugin URI: https://hupfeld-software.de/plugins/mastadon-timeline/#!README.md
* Description: Plugin zur Darstellung der Mastadon Timeline
* Version: 0.01
* Author: Walter Hupfeld
* Datum: 17.11.2022
* Author URI: http://www.hupfeld-software.de
*/

if (!defined('ABSPATH')) {
    exit; 
}

require("mas-body.php");

add_action('mas_enqueue_scripts','mas_style_and_script');  // add custom style and script
function mas_style_and_script()
{
    // css
    wp_register_style( 'mas-style', plugins_url('mastodon-timeline.css', __FILE__) ); 
    // js
    wp_register_script( 'mas-script', plugins_url('mastodon-timeline.js', __FILE__), array('jquery') );  
}

add_shortcode( 'mastodon-timeline', 'mastodon_timeline' );

// Monatsnavigation
function mastodon_timeline( $atts, $content = null) {
    wp_enqueue_style("mas-style");
    wp_enqueue_script("mas-script");
    $strBody = mas_body();
    return $strBody;
}