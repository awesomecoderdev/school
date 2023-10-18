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
 * 		The actions of the themes
 * ======================================================================================
 */

// Step 1: Create a function to display the custom field
function school_address_field()
{
    $school_address = get_option('school_address'); // Retrieve the saved value
    // Output the HTML for your custom field
    echo '<input class="regular-text" placeholder="Enter Schools Address" type="text" id="school_address" name="school_address" value="' . esc_attr($school_address) . '" />';
}

function school_phone_field()
{
    $school_phone = get_option('school_phone'); // Retrieve the saved value
    // Output the HTML for your custom field
    echo '<input class="regular-text" placeholder="Enter Schools Phone" type="text" id="school_phone" name="school_phone" value="' . esc_attr($school_phone) . '" />';
}

function add_school_address_to_general_settings()
{
    add_settings_field(
        'school_address',
        __("School Address", "school"),
        'school_address_field',
        'general',
        'default',
        array(
            'label_for' => 'school_address',
        )
    );

    add_settings_field(
        'school_phone',
        __("School Contact Phone", "school"),
        'school_phone_field',
        'general',
        'default',
        array(
            'label_for' => 'school_phone',
        )
    );


    register_setting('general', 'school_address');
    register_setting('general', 'school_phone');
}
add_action('admin_init', 'add_school_address_to_general_settings');


/**
 * Register custom class for nav items.
 *
 * @since    1.0.0
 */
function add_class_on_nav_menu_list_items($classes, $item, $args)
{

    // file_put_contents(SCHOOL_THEME_PATH . "/args.txt", json_encode($args, JSON_PRETTY_PRINT));
    // file_put_contents(SCHOOL_THEME_PATH . "/classes.txt", json_encode($classes, JSON_PRETTY_PRINT));
    // file_put_contents(SCHOOL_THEME_PATH . "/item_$item->ID.txt", json_encode($item, JSON_PRETTY_PRINT));
    // if ('primary' === $args->theme_location) {
    //     $classes[] = strtolower($item->title);
    // }
    $classes[] = strtolower($item->title);


    if (!in_array('current-menu-item', $classes)) {
        if (in_array('current_page_item', $classes)) {
            $classes[] = 'text-primary-500 dark:text-white';
        }
    } else {
        $classes[] = 'text-primary-500 dark:text-white';
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
    if ('primary' === $args->theme_location || is_null($args->theme_location)) {
        $classes["class"] = "relative flex justify-center items-center $args->theme_location " . $args->has_children ? "text-sm lending-5" : "";
    }

    // file_put_contents(SCHOOL_THEME_PATH . "/args.txt", json_encode($args, JSON_PRETTY_PRINT));

    // $classes["class"] = "relative flex justify-center items-center $args->theme_location";

    return $classes;
}
add_filter("nav_menu_link_attributes", "add_class_on_nav_menu_list_items_link", 10, 3);
