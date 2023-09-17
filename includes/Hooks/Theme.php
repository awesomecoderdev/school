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
 * Register custom class for nav items.
 *
 * @since    1.0.0
 */
function add_class_on_nav_menu_list_items($classes, $item, $args)
{
    if ('primary' === $args->theme_location) {
        $classes[] = "nav__item " . "nav_" . strtolower($item->title);
    }

    if (!in_array('active-link', $classes)) {
        if (!in_array('current-menu-item', $classes)) {
            if (in_array('current_page_item', $classes)) {
                $classes[] = 'active-link ';
            }
        } else {
            $classes[] = 'active-link ';
        }
    }

    return $classes;
}

add_filter("nav_menu_css_class", "add_class_on_nav_menu_list_items", 10, 3);

/**
 * Register custom class for nav links.
 *
 * @since    1.0.0
 */
function add_class_on_nav_menu_list_items_link($classes, $item, $args)
{
    if ('primary' === $args->theme_location) {

        $classes["class"] = "nav__link ";
    }
    return $classes;
}
add_filter("nav_menu_link_attributes", "add_class_on_nav_menu_list_items_link", 10, 3);

/**
 * ======================================================================================
 * 		Theme Support Functions
 * ======================================================================================
 */

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
    'height'               => 50,
    'width'                => 180,
    'flex-height'          => true,
    'flex-width'           => true,
    'header-text'          => array('site-title', 'site-description'),
    'unlink-homepage-logo' => true,
));


/**
 * Register the thumbnail theme support for the admin area.
 *
 * @since    1.0.0
 */
add_theme_support("post-thumbnail");

/**
 * Register the background theme support for the admin area.
 *
 * @since    1.0.0
 */
// add_theme_support("custom-background");


/**
 * Register the header theme support for the admin area.
 *
 * @since    1.0.0
 */
// add_theme_support("custom-header");

/**
 * Register the sidebar theme support for the admin area.
 *
 * @since    1.0.0
 */
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
add_action('widgets_init', 'school_sidebar');


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
        $wp_customize->add_setting("text_color", array(
            "type" => "theme_mod",
            "default" => "",
            "sanitize_callback" => "sanitize_text_field",
        ));
        $wp_customize->add_control("text_color", array(
            "label" => "Text Color",
            "section" => "colors",
            "type" => "color",
        ));

        // end: colors section ========================================

    }
}
