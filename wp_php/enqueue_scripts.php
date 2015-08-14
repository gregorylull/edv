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

/*
  wp_enqueue_script 
  wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer )

*/

// scripts to load from html for our app
function edv_scripts () {
  // jquery 
  // wp_enqueue_script( 'jquery', get_template_directory_uri() . bower_path("jquery"), array("edv_theme_local"));

  // angular core and library
  wp_enqueue_script( 'angular', get_template_directory_uri() . bower_path("angular"), array("edv_theme_local")); 
  wp_enqueue_script( 'angularRoute', get_template_directory_uri() . bower_path("angularRoute"), array("edv_theme_local")); 
  
  // foundation css
  wp_enqueue_style( 'normalize', get_template_directory_uri() . bower_path("normalize"));
  // wp_enqueue_style( 'foundationCSS', get_template_directory_uri() . bower_path("foundationCSS")); 

  // foundation js
  wp_enqueue_script( 'modernizr', get_template_directory_uri() . bower_path("modernizr"), array("edv_theme_local"));   
  // wp_enqueue_script( 'foundationJS', get_template_directory_uri() . bower_path("foundationJS"), array("edv_theme_local"));   

  // app scripts
  wp_enqueue_script( 'angular-build', get_template_directory_uri() . "/build/js/production.js");

  // CSS files
  wp_enqueue_style( 'edv_style_sheet', get_stylesheet_uri());
  wp_enqueue_style( 'edv_scss_css_sheet', get_template_directory_uri() . "/build/css/app.css");

  // localize default and admin theme options
  wp_register_script( 'edv_theme_local', get_template_directory_uri() . js_path("localized_wp_scripts.js"));
  
  $translation_array = array(
    "options" => get_theme_mods(),
    "dirPath" => get_template_directory_uri(),
  );

  wp_localize_script( 'edv_theme_local', 'edvThemeLocal', $translation_array );

  wp_enqueue_script('edv_theme_local');

  // localize posts and pages
  wp_register_script( 'edv_content', get_template_directory_uri() . js_path("localized_wp_scripts.js"));
  
  $translation_array = array(
    "ngPath" => get_template_directory_uri() . ng_path(), // for angular templates
    "posts" => new WP_Query( array(
      'category_name'=>'navmain,navsub',
      'post_type'=>'post',
    )),
    "pages" => new WP_Query ( array(
      'post_type' => 'page',
      'post_parent'=>'0'
    ))
  );

  wp_localize_script( 'edv_content', 'edvContent', $translation_array );

  wp_enqueue_script('edv_content');
}

?>