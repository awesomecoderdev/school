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
function custom_settings_field()
{
    $custom_field_value = get_option('school_address'); // Retrieve the saved value
    // Output the HTML for your custom field
    echo '<input class="regular-text" placeholder="Enter Schools Address" type="text" id="school_address" name="school_address" value="' . esc_attr($custom_field_value) . '" />';
}

function add_school_address_to_general_settings()
{
    add_settings_field(
        'school_address',
        __("School Address", "school"),
        'custom_settings_field',
        'general',
        'default',
        array(
            'label_for' => 'school_address',
        )
    );

    register_setting('general', 'school_address');
}
add_action('admin_init', 'add_school_address_to_general_settings');
