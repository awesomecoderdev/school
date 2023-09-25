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


// Replace the default slug with the custom color field in the term list table
add_filter('manage_edit-product_color_columns', 'school_taxonomy_custom_column');
function school_taxonomy_custom_column($columns)
{
    $new_columns = [
        "cb"            => "<input type=\"checkbox\" />",
        "name"          => __('Name', 'school'),
        "color"         => __('Color', 'school'),
        "description"   => __('Description', 'school'),
        "slug"          => __('Slug', 'school'),
        "posts"         => __('Count', 'school'),
    ];

    return $new_columns;
}

// show the color in table
add_filter('manage_product_color_custom_column', 'school_taxonomy_custom_column_data', 9999, 3);
function school_taxonomy_custom_column_data($deprecated, $column_name, $term_id)
{
    if ($column_name === 'color') {
        $color = get_school_product_color($term_id);

        return $color ? "<div style=\"height:30px;width:30px;border:1px solid;border-radius:100%;background: $color;\"></div>" : '-';
    }
}

/**
 * Create two taxonomies, colors for the post type "book".
 *
 * @see register_post_type() for registering custom post types.
 */
function school_create_color_taxonomies()
{
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x('Colors', 'taxonomy general name', 'school'),
        'singular_name'              => _x('Color', 'taxonomy singular name', 'school'),
        'search_items'               => __('Search Colors', 'school'),
        'popular_items'              => __('Popular Colors', 'school'),
        'all_items'                  => __('All Colors', 'school'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Color', 'school'),
        'update_item'                => __('Update Color', 'school'),
        'add_new_item'               => __('Add New Color', 'school'),
        'new_item_name'              => __('New Color Name', 'school'),
        'separate_items_with_commas' => __('Separate Colors with commas', 'school'),
        'add_or_remove_items'        => __('Add or remove Colors', 'school'),
        'choose_from_most_used'      => __('Choose from the most used Colors', 'school'),
        'not_found'                  => __('No Colors found.', 'school'),
        'menu_name'                  => __('Colors', 'school'),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'description'           => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'color'),
        'public'                => false, // Disable the public slug
    );

    register_taxonomy('product_color', 'product', $args);
}
// hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'school_create_color_taxonomies', 0);


// Add custom field to term edit form
add_action("product_color_add_form_fields", 'school_taxonomy_add_form_fields', 10);
function school_taxonomy_add_form_fields($color)
{
?>
    <div class="form-field form-required term-color-wrap">
        <label for="color"><?php _e("Color", "school"); ?></label>
        <div class="school-color-wrap">
            <input name="color" id="color" class="primary" type="color">
        </div>
    </div>

<?php
}

add_action('product_color_edit_form_fields', 'school_taxonomy_edit_form_fields', 10, 2);
function school_taxonomy_edit_form_fields($color, $taxonomy)
{
    $color = get_school_product_color($color->term_id);
?>
    <tr class="form-field form-required term-color-wrap">
        <th scope="row"> <label for="color"><?php _e("Color", "school"); ?></label></th>
        <td>
            <div class="school-color-wrap">
                <input name="color" id="color" class="primary" type="color" value="<?php echo $color; ?>" data-default-color="<?php echo $color; ?>">
            </div>
        </td>
    </tr>
<?php
}

// Save custom field when editing term
add_action('edited_product_color', 'school_taxonomy_save_custom_fields', 10);
add_action('create_product_color', 'school_taxonomy_save_custom_fields', 10);
function school_taxonomy_save_custom_fields($term_id)
{
    if (isset($_POST['color'], $_POST["taxonomy"]) && $_POST["taxonomy"] == "product_color") {
        $color = sanitize_text_field($_POST['color']);
        update_term_meta($term_id, 'color', $color);
    }
}


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
