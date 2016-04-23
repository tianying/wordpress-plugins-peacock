<?php
/**
 * @package Peacock Company
 */
/*
Plugin Name: Peacock Company
Plugin URI: http://www.cloudlake.link/plugins/suzaku
Description: 企业模版网站的信息、管理插件。
Version: 0.0.1
Author: cloudlake
Author URI: http://www.cloudlalke.link
License: The MIT License
Text Domain: Peacock Company
*/


define( 'PEACOCK_COMPANY_VERSION', '0.0.1' );
define( 'PEACOCK_COMPANY__MINIMUM_WP_VERSION', '4.2' );
define( 'PEACOCK_COMPANY__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PEACOCK_COMPANY__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PEACOCK_COMPANY_DELETE_LIMIT', 100000 );

register_activation_hook( __FILE__, array( 'Peacock Company', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Peacock Company', 'plugin_deactivation' ) );

add_action( 'init', array( 'Peacock Company', 'init' ) );

require_once( PEACOCK_COMPANY__PLUGIN_DIR . 'function.php' );

require_once( PEACOCK_COMPANY__PLUGIN_DIR . 'custom-type.php' );

require_once( PEACOCK_COMPANY__PLUGIN_DIR . 'custom-fields.php' );

require_once( PEACOCK_COMPANY__PLUGIN_DIR . 'shortcode.php' );

require_once( PEACOCK_COMPANY__PLUGIN_DIR . 'custom-template.php' );


?>
