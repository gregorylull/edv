<?php
/*
  docs: https://codex.wordpress.org/Theme_Customization_API

  Theme review team
  - Chip Bennet (11/24/2014). Understanding the APIs related to theme options. https://make.wordpress.org/themes/2014/11/24/understanding-the-apis-related-to-theme-options/

  - Chip Bennet (07/08/2014). Using Sane Defaults in Themes. https://make.wordpress.org/themes/2014/07/09/using-sane-defaults-in-themes/ (last retrieved 04/09/2015)

  docs: http://codex.wordpress.org/Creating_Options_Pages
  tut: http://ottopress.com/2009/wordpress-settings-api-tutorial/

  Stack
  - Settings API vs Theme Customizer (05/01/2013). http://wordpress.stackexchange.com/questions/97929/settings-api-vs-theme-customizer
*/
define(__BREAK__, "</br>" . PHP_EOL);

require_once( __DIR__ . "/menu_creation_tools.php" );

/*-----------------------------------------------------------------------------
    # STORING and RETREIVING options in the database
    WP has two APIs for storing and retrieving THEME options
    - Options API :: "granddaddy" API, used by core, Plugins, and Themes
    - Theme Modification (Theme Mods) API :: Theme-specific API

    Options API
    - STORE :: add_option() and update_option()
    - RETRIEVE :: get_option()

    Theme Mod API
    - STORE :: set_theme_mod()
    - RETRIEVE :: get_theme_mod() and get_theme_mods()

    *IMPORTANT*  NEITHER API deals with user configuration (Settings page) of options


    # USER CONFIGURATION of options
    Essentially three ways to allow users to configure theme options
      1. Settings-API generated page
      2. custom settings page
      3. Customizer API

    All three types either use Settinsg API or Theme Mods API to retrieve and store settings.

    (WP Theme Review Guidelines recommends using the Customizer API)

    The Customizer API
    - is NOT for storing or retrieving options, it is an API for user configuration of settings.
    - is NOT a replacement for Settings API nor Theme Mod API
    -  IS a replacement for Theme settings page

-----------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------
    What types of settings?

What is the easiest way of updating documents?
- excel file?
- copying and pasting kinda sucks...but excel file is an extra level of complexity, bugs a plenty
- spell check on blogs and settings?

HEADER
- Links
- Eng, Chinese, Korean, Spanish

HOMEPAGE
- background color
- foreground color 
- Header font type, color, size
- Text font type
- Link color, hover color, clicked color

Homepage - widgets / modules ? How to use existing WP modules?
- Slideshow and pictures (dynamic / widget)
  + picture
  + picture link
  + background color
  + title
  + caption

- about us, process, case studies, 3 columns
  + pic
  + pic container image / color ?
  + title (opt)
  + description (opt)
  + link (opt)
- Live social media plugins

FOOTER
- 3 column

-----------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------
    add_setting( string $id, array $args )
    + adds a new setting to the database
    + NOT interactive, no view, just DB, use in conjunction with add_section and add_control

    :: string $id - unique slug
    :: array $args - associative array
      : default - default setting
      : type - specifies TYPE, option or theme_mod
      : capability - define user capability
      : theme_supports - used to hide a setting if the theme lacks support
      : transport - refresh, postMessage (requires javascript setup)
      : sanitize_callback - sanitize input, some kind of filter function
      : sanitize_js_callback - sanitizes input for purpose of outputting to javascript code


    https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting

-----------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------
    add_section(string $id, array $args)
    + adds a new 'section' (category/group) to the Theme Customizer page

    :: string $id - unique slug
    :: array $args - associative array
      : title
      : priority
      : description 

    DEFAULT SECTIONS:
      : title_tagline
      : colors
      : background_image
      : nav
      : static_front_page


    https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
-----------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------
    add_control(mixed $id, array $args)
    + creates an HTML control that admins can use to change settings
    + also choose a section for the ctonrol to appear in

    :: $args can be an instance of WP_Customize_Control
      : label => descriptive words
      : section => your_section_id
      : settings => your_setting_id
      : type => radio, textarea, etc.  // if value is not valid, script will break
      : choices => associative array (value => "Description of Value")

    https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
-----------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------
    get_setting($unique_option_slug)
    + modify properties of a setting that has ALREADY been created
    + returns object matching add_setting() params: default, type, capability, transport
    + setter and getter

    ex:
    $wp_customize->get_setting('blogname')->transport = "postMessage";
-----------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------
    get_theme_mod() / get_theme_mods() // not part of $wp_customize
    - retrieves ONLY if used 'customize_register' action
    - option: use wp_head and output <style/> tags directly into <head/>
-----------------------------------------------------------------------------*/

function edv_theme_menu_customize_register ($wp_customize) {
  // --- BACKGROUND COLOR ---
  // add section
  $wp_customize->add_section(
    "edv_default_background_color_sec",
    array(
      "title" => "Default Background Color",
      // "priority" => 0,
      "description" => "This is a SECTION"
    )
  );

//   // add setting
//   /*
//       : default - default setting
//       : type - specifies TYPE, option or theme_mod
//       : capability - define user capability
//       : theme_supports - used to hide a setting if the theme lacks support
//       : transport - refresh, postMessage (requires javascript setup)
//       : sanitize_callback - sanitize input, some kind of filter function
//       : sanitize_js_callback - for javascript
// */

  define(__edv__, "theme_mods_edventures");

  $wp_customize->add_setting(
    "edv_default_background_color_set",
    array(
      "default" => "#ffff00",
      "type" => "theme_mod",
      "capability" => "manage_options"
    )
  );

//   // add control
//   /*
//       : label => descriptive words
//       : section => your_section_id
//       : settings => your_setting_id
//       : type => radio, textarea, etc.
//       : choices => associative array (value => "Description of Value")
//   */
  $wp_customize->add_control(
    "edv_default_background_color_ctrl",
    array(
      "label" => "Choose the default background color",
      "section" => "edv_default_background_color_sec",
      "settings" => "edv_default_background_color_set",
      "type" => "text"
    )
  );

}

?>
