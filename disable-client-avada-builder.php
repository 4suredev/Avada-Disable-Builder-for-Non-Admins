<?php
/**
 * Plugin Name: Avada Disable Builder for Non-Admins
 * Plugin URI: https://4sure.com.au
 * Description: Disables Avada builder for all roles except administrator
 * Version: 1.0.1
 * Requires PHP: 7.2
 * Requires at least: 5.8
 * Author: 4sure
 * Author URI: https://4sure.com.au
 */
include_once( plugin_dir_path( __FILE__ ) . 'updater.php');
$updater = new Disable_non_admin_avada_updater( __FILE__ ); 
$updater->set_username( '4suredev' ); 
$updater->set_repository( 'Avada-Disable-Builder-for-Non-Admins' ); 
$updater->initialize(); 
if( ! class_exists( 'Disable_non_admin_avada_updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}
function disable_client_avada_builder( $post_types ) {
    if(current_user_can('administrator')){
        $post_types[] = 'page';
        $post_types[] = 'post';
    }else{
        $post_types = \array_diff($post_types, ['page', 'post']);
    }
    return $post_types;
}
add_filter( 'fusion_builder_allowed_post_types', 'disable_client_avada_builder' );
add_filter( 'fusion_builder_default_post_types', 'disable_client_avada_builder' );