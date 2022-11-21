<?php
/**
* Plugin Name: Mastodon Timeline
* Plugin URI: https://hupfeld-software.de/plugins/mastadon-timeline/#!README.md
* Description: Plugin zur Darstellung der Mastodon Timeline (benutzt https://gitlab.com/idotj/mastodon-embed-feed-timeline)
* Version: 0.03
* Author: Walter Hupfeld
* Datum: 21.11.2022
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
    // js
    wp_register_script( 'mas-script', plugins_url('js/mastodon-timeline.js', __FILE__), array('jquery') );  
}


/** **************************************************
 *   Shortcode
***************************************************** */ 

add_shortcode( 'mastodon-timeline', 'mastodon_timeline' );

// Monatsnavigation
function mastodon_timeline($atts,$content=null) {
    $param = array();
    /*
    $param['instance_uri'] = 'https://nrw.social';
    $param['user_id'] = '109245751255389357';
    $param['profile_name'] = '@radwegehamm';
    $param['toots_limit'] = '6';
    */
    $param['instance_uri'] = get_option('mas_instance_url');
    $param['user_id'] = get_option('mas_user_id');
    $param['profile_name'] = get_option('mas_profile_name');
    $param['toots_limit'] = get_option('mas_toots_limit');

    wp_enqueue_style("mas-style");
    wp_enqueue_style("style");   
    wp_enqueue_script("mas-script");
    $strBody = mas_body($param);
    return $strBody;
}
/* ----------------------------------------------
  Admin-Bereich
-------------------------------------------------  */  


register_activation_hook( __FILE__, 'mas_activate_plugin' );
function mas_activate_plugin() {
    if (!get_option('mas_instance_url')) update_option('mas_instance_url','https://nrw.social');
    if (!get_option('mas_user_id'))  update_option('mas_user_id','109245751255389357');
    if (!get_option('mas_profile_name')) update_option('mas_profile_name','@radwegehamm');
    if (!get_option('mas_toots_limit')) update_option('mas_toots_limit','6');
}

add_action('admin_menu', 'mas_create_menu');
function mas_create_menu(){

    //create admin side menu
    //add_menu_page( __( 'News Grabber' ), __( 'News Grabber' ), 'administrator', 'wp-pg', 'ph_settings_page');
    //create option
    add_options_page( __( 'Mastodon Timeline' ), __( 'Mastodon Timeline' ), 'administrator', 'mas-pg', 'mastodon_settings_page');
    //call register settings function
    add_action( 'admin_init', 'mas_settings' );
}

function mas_settings(){
    //register our settings
        register_setting( 'mas-settings-group', 'mas_instance_url' );
        register_setting( 'mas-settings-group', 'mas_user_id' );
        register_setting( 'mas-settings-group', 'mas_profile_name' );
        register_setting( 'mas-settings-group', 'mas_toots_limit' );
     }  

function mastodon_settings_page(){
    // Admin side page options
        $mas_instance_url = get_option('mas_instance_url');
        $mas_user_id = get_option('mas_user_id');
        $mas_profile_name = get_option('mas_profile_name');
        $mas_toots_limit = get_option('mas_toots_limit');
        ?>
            <div class='wrap'>
                <h2><?php _e( 'Mastodon ' ); ?></h2>
                <form method='post' action='options.php'>
                    <?php settings_fields( 'mas-settings-group' ); ?>
                    <?php do_settings_sections( 'mas-settings-group' ); ?>
                    <table class='form-table'>
                        <tr valign='top'>
                            <th scope='row'><?php _e( 'URL der Instanz:' ); ?></th>
                            <td>
                                <input type="text"  size="40" value="<?php 
                                if ($mas_instance_url != NULL) { echo $mas_instance_url; } 
                                else { echo ""; }?>" name="mas_instance_url"><br>
                                <br>
                            </td>
                        </tr>
                        <tr valign='top'>
                            <th scope='row'><?php _e( 'User ID:' ); ?></th>
                            <td>
                                <input type="text"  size="40" value="<?php 
                                if ($mas_user_id != NULL) { echo $mas_user_id; } 
                                else { echo ""; }?>" name="mas_user_id"><br>
                                <br>
                                <small>Die Mastodon-Id kann man <a href="https://prouser123.me/mastodon-userid-lookup/" target="_blank">hier</a> herausfinden</small>
                                <br>
                            </td>
                        </tr>
                        <tr valign='top'>
                            <th scope='row'><?php _e( 'Profil Name:' ); ?></th>
                            <td>
                                <input type="text"  size="40" value="<?php 
                                if ($mas_profile_name != NULL) { echo $mas_profile_name; } 
                                else { echo ""; }?>" name="mas_profile_name"><br>
                                <br>
                            </td>
                        </tr>
                        <tr valign='top'>
                            <th scope='row'><?php _e( 'Anzahl Einträge:' ); ?></th>
                            <td>
                                <input type="text"  size="40" value="<?php 
                                if ($mas_toots_limit != NULL) { echo $mas_toots_limit; } 
                                else { echo ""; }?>" name="mas_toots_limit"><br>
                                <small>Anzahl der angezeigeten Toots</small>
                                <br>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
    
        <?php
    }

register_uninstall_hook( __FILE__, 'mas_uninstall' ); // uninstall plug-in
    function mas_uninstall() {
        delete_option('mas_instance_url');
        delete_option('mas_user_id');
        delete_option('mas_profile_name');
        delete_option('mas_toots_limit');
     }
