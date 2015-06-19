<?php

// returns path for bower stuff, path directories are hardcoded into associative array
function bower_path ($filename, $min=true) {
  $array = array(
    "angular" => "angular/angular.js",
    "jquery" => "jquery/dist/jquery.min.js",
    "foundation" => "foundation/css/foundation.min.css",
    "normalize" => "foundation/css/normalize.min.css",
    "foundationJS" => "foundation/js/foundation.min.js"
  );
  $partial_path = $array[$filename];
  return "/bower_components/" . $partial_path;
}

// returns path for javascript files, default directory is /js/
function js_path ($filename, $dir="/js/") {
  return $dir . $filename;
}

// returns path for php files NOT related to wordpress
function wp_php_path ($filename, $dir="/wp_php/") {
  return $dir . $filename;
}

// returns path for php files related to wordpress
function php_path ($filename, $dir="/php/") {
  return $dir . $filename;
}

function ng_path ($filename="", $dir="/js/angularApp/") {
  return $dir . $filename;
}

?>
