<?php

/**
 * The theme support.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this template as well as the current
 * version of the template.
 *
 * @since      1.0.0
 * @package    School
 * @subpackage School/includes
 * @author     Mohammad Ibrahim Kholil <awesomecoder.dev@gmail.com>
 *
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */



/**
 * ======================================================================================
 * 		product after before contents
 * ======================================================================================
 */

/**
 * Register the nav menu for the admin area.
 *
 * @since    1.0.0
 */
register_nav_menus(array(
    'primary' => __('( School ) Primary Menu', 'school'),
));

/**
 * Register dynamic title.
 *
 * @since    1.0.0
 */
add_theme_support('title-tag');


/**
 * Register dynamic logo.
 *
 * @since    1.0.0
 */
add_theme_support('custom-logo', array(
    'height'               => 120,
    'width'                => 120,
    'flex-height'          => true,
    'flex-width'           => true,
    'header-text'          => array('site-title', 'site-description'),
    'unlink-homepage-logo' => true,
));


/**
 * Gutenberg wide images.
 *
 * @since    1.0.0
 */
add_theme_support('align-wide');


/**
 *  Add default posts and comments RSS feed links to head.
 *
 * @since    1.0.0
 */
add_theme_support('automatic-feed-links');


/**
 * Register the thumbnail theme support for the admin area.
 *
 * @since    1.0.0
 */
add_theme_support("post-thumbnails");
add_image_size('custom-thumbnail-size', 150, 150, true);


/**
 * Register the background theme support for the admin area.
 *
 * @since    1.0.0
 */
add_theme_support("custom-background");


/**
 * Customize Selective Refresh Widgets
 *
 * @since    1.0.0
 */

 add_theme_support('customize-selective-refresh-widgets');

 /**
  * Register the header theme support for the admin area.
  *
  * @since    1.0.0
  */
 // add_theme_support("custom-header");


/**
 * Switch default core markup for search form, comment form, and comments.
 *
 * @since    1.0.0
 */

// to output valid HTML5.
// Added a new value in HTML5 array 'navigation-widgets' as this was introduced in WP5.5 for better accessibility.
add_theme_support(
    'html5',
    array(
        'navigation-widgets',
        'search-form',
        'gallery',
        'caption',
        'style',
        'script',
    )
);

/**
 * Register the sidebar theme support for the admin area.
 *
 * @since    1.0.0
 */
add_action('widgets_init', 'school_sidebar');
if (!function_exists("school_sidebar")) {
    function school_sidebar()
    {
        register_sidebar(array(
            'name'          => __('School Sidebar', "school"),
            'id'            => 'school_sidebar',
            'description'   => 'Widgets in this area will be shown on all posts and pages.',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ));
    }
}


/**
 * Register the wordpress customizer
 *
 * @since    1.0.0
 */
add_action("customize_register", 'school_wp_customize');
if (!function_exists("school_wp_customize")) {
    function school_wp_customize($wp_customize)
    {


        // start: copyright section ========================================

        /**
         * Create Customizer Copyright Section
         *
         * @since    1.0.0
         *
         **/
        $wp_customize->add_section("sec_copyright", array(
            "title"             => "Copyright Settings",
            "description"       => "This is copyright section.",
        ));

        /**
         * Adding copyright text
         *
         * @since    1.0.0
         *
         **/
        $wp_customize->add_setting("copyright_text", array(
            "type" => "theme_mod",
            "default" => get_bloginfo("title"),
            "sanitize_callback" => "sanitize_text_field",
        ));
        $wp_customize->add_control("copyright_text", array(
            "label" => "Copyright",
            "description" => "Please fill the copyright text field.",
            "section" => "sec_copyright",
            "type" => "text",
        ));


        /**
         * adding copyright year
         *
         * @since    1.0.0
         *
         **/
        $wp_customize->add_setting("copyright_year", array(
            "type" => "theme_mod",
            "default" => "",
            "sanitize_callback" => "sanitize_text_field",
        ));
        $wp_customize->add_control("copyright_year", array(
            "label" => "Year",
            "description" => "Please fill the copyright year field.",
            "section" => "sec_copyright",
            "type" => "number",
        ));

        // end: copyright section ========================================


        // start: social section ========================================

        /**
         * Create Customizer Social Section
         *
         * @since    1.0.0
         *
         **/
        $wp_customize->add_section("sec_social", array(
            "title"             => "Social Settings",
            "description"       => "This is social section.",
        ));

        /**
         * Adding facebook link
         *
         * @since    1.0.0
         *
         **/
        $wp_customize->add_setting("facebook_link", array(
            "type" => "theme_mod",
            "default" => "https://facebook.com/",
        ));
        $wp_customize->add_control("facebook_link", array(
            "label" => "Facebok",
            "description" => "Put here your facebook profile link.",
            "section" => "sec_social",
            "type" => "text",
        ));



        /**
         * Adding instagram link
         *
         * @since    1.0.0
         *
         **/
        $wp_customize->add_setting("instagram_link", array(
            "type" => "theme_mod",
            "default" => "https://www.instagram.com/",
        ));
        $wp_customize->add_control("instagram_link", array(
            "label" => "Instagram",
            "description" => "Put here your instagram profile link.",
            "section" => "sec_social",
            "type" => "text",
        ));



        /**
         * Adding twiter link
         *
         * @since    1.0.0
         *
         **/
        $wp_customize->add_setting("twitter_link", array(
            "type" => "theme_mod",
            "default" => "https://twitter.com/",
        ));
        $wp_customize->add_control("twitter_link", array(
            "label" => "Twitter",
            "description" => "Put here your twitter profile link.",
            "section" => "sec_social",
            "type" => "text",
        ));

        // end: social section ========================================


        // start: colors section ========================================

        /**
         * adding hover color
         *
         *
         *
         * @since    1.0.0
         *
         **/

        $colors = get_school_theme_colors();

        foreach ($colors as $key => $color) {
            $wp_customize->add_setting("color-$key", array(
                "type" => "theme_mod",
                "default" => "$color",
                // "transport" => "refresh",
                "sanitize_callback" => "sanitize_text_field",
            ));
            $wp_customize->add_control("color-$key", array(
                "label" => __("Primary $key", "school"),
                "section" => "colors",
                "type" => "color",
            ));
        }


        // end: colors section ========================================

    }
}


/**
 * Register header for the output colors.
 *
 * @since    1.0.0
 */
add_action('customizer_theme_colors', 'school_theme_colors');
if (!function_exists("school_theme_colors")) {
    function school_theme_colors()
    {
        echo get_school_contents("/template/components/customizer.php");
    }
}
