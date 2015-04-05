<?php
/*
  ENQUEUE SCRIPTS
*/
add_action( 'wp_enqueue_scripts', 'edv_scripts' );

function bower_path ($filename, $min=true) {
  $array = array(
    "angular" => "angular/angular.js",
  );
  $partial_path = $array[$filename];
  return "/bower_components/" . $partial_path;
}

function js_path ($filename, $dir="/js/") {
  return $dir . $filename;
}

function edv_scripts () {
  // angular core and library
  wp_enqueue_script( 'angular', get_template_directory_uri() . bower_path("angular") ); 

  // app scripts
  wp_enqueue_script( 'app', get_template_directory_uri() . js_path( "app.js", "/") );

  // CSS files
  wp_enqueue_style( 'edv-style', get_stylesheet_uri());
}

?>

