<?php

/*

  1. scripts should be registered, usually because they have dependencies
  2. repetitive, use some function and for loop

  [
    handle => unique
    src = false
    dependencies = array()
    version=false
    $in_footer=false
    register => true /false,
    enqueue => true / false,

    [
      handle,
      path,
      dep,

    ]
  ]

  masterList = array(
    array(array(angular, ["bower", "angular"], dependencies[], ...), array(true, false))
  );

  can preprocess first
  path: [$pathFunc, $handle, $path]

  wp_script_is($handle, "enqueued/queue/registered/done/to_do" = enqueued)

*/

// scripts to load from html for our app
function edv_scripts () {
  // angular core and library
  wp_enqueue_script( 'angular', get_template_directory_uri() . bower_path("angular"), array("edv_theme_local")); 

  // jquery 
  wp_enqueue_script( 'jquery', get_template_directory_uri() . bower_path("jquery"), array("edv_theme_local"));

  // app scripts
  wp_enqueue_script( 'app', get_template_directory_uri() . js_path( "app.js", "/") );

  // CSS files
  wp_enqueue_style( 'edv_style_sheet', get_stylesheet_uri());

  // localize default and admin theme options
  wp_register_script( 'edv_theme_local', get_template_directory_uri() . js_path("localized_wp_scripts.js"));
  $translation_array = array(
    "options" => get_theme_mods()
  );
  wp_localize_script( 'edv_theme_local', 'edvThemeLocal', $translation_array );
}

?>