<?php
/**
* Plugin Name: Mastodon Timeline
* Plugin URI: https://hupfeld-software.de/plugins/mastadon-timeline/#!README.md
* Description: Plugin zur Darstellung der Mastodon Timeline (benutzt https://gitlab.com/idotj/mastodon-embed-feed-timeline)
* Version: 0.02
* Author: Walter Hupfeld
* Datum: 19.11.2022
* Author URI: http://www.hupfeld-software.de
*/

if (!defined('ABSPATH')) {
    exit; 
}

require("mas-body.php");

add_action('wp_enqueue_scripts','mas_style_and_script');
function mas_style_and_script()
{
    // css
    wp_register_style( 'mas-style', plugins_url('css/mastodon-timeline.css', __FILE__) ); 
    wp_register_style( 'style', plugins_url('css/style.css', __FILE__) ); 
    // js
    wp_register_script( 'mas-script', plugins_url('js/mastodon-timeline.js', __FILE__), array('jquery') );  
}

add_shortcode( 'mastodon-timeline', 'mastodon_timeline' );

// Monatsnavigation
function mastodon_timeline($atts,$content=null) {
    $param = array();
    $param['instance_uri'] = 'https://nrw.social';
    $param['user_id'] = '109245751255389357';
    $param['profile_name'] = '@radwegehamm';
    $param['toots_limit'] = '6';

    wp_enqueue_style("mas-style");
    wp_enqueue_style("style");   
    wp_enqueue_script("mas-script");
    $strBody = mas_body($param);
    return $strBody;
}