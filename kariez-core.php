<?php
/*
Plugin Name: Kariez Core
Plugin URI: https://www.radiustheme.com
Description: Kariez Theme Core Plugin
Version: 1.1.1
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'KARIEZ_CORE' ) ) {
	define( 'KARIEZ_CORE', '1.1.1' );
	define( 'KARIEZ_CORE_PREFIX', 'kariez' );
	define( 'KARIEZ_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'KARIEZ_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'RT\\KariezCore\\Init' ) ) :
	RT\KariezCore\Init::instance();
endif;

define( 'RDTHEME_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . '/demo-content/' );
define( 'RDTHEME_CORE_BASE_URL', plugin_dir_url( __FILE__ ) . 'demo-content/' );

require_once RDTHEME_CORE_DEMO_CONTENT . 'demo-content.php';