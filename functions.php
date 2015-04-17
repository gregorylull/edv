<?php

/**----------------------------------------------------------------------------
  SERVER SIDE
-----------------------------------------------------------------------------*/

// require utilities for path names
require_once( __DIR__ . '/php/pathname_utilities.php' );


// /**----------------------------------------------------------------------------
//   ADMIN
// -----------------------------------------------------------------------------*/

// // require and execute menu creation
if ( current_user_can('manage_options') ) {
  require_once( __DIR__ . wp_php_path('menu_creation.php') );
  add_action( 'customize_register', 'edv_theme_menu_customize_register' );
}

// /**----------------------------------------------------------------------------
//   VISITOR
// -----------------------------------------------------------------------------*/

// require and enqueue scripts for loading angular, and app stuff
require_once( __DIR__ . wp_php_path('enqueue_scripts.php') );
add_action( 'wp_enqueue_scripts', 'edv_scripts' );

// localize theme options to be used for angular

?>
