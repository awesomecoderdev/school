<?php

namespace AwesomeCoder\School\Core;

use Automattic\WooCommerce\Internal\AssignDefaultCategory;

/**
 * Taxonomies class.
 */
class Taxonomies
{
	/**
	 * Class instance.
	 *
	 * @var Taxonomies instance
	 */
	protected static $instance = false;

	/**
	 * Default category ID.
	 *
	 * @var int
	 */
	private $default_cat_id = 0;

	/**
	 * Get class instance
	 */
	public static function run()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public $placeholder_image;


	/**
	 * Constructor.
	 */
	public function __construct()
	{
		// Default category ID.
		$this->default_cat_id = get_option('default_category', 0);
		$this->placeholder_image = esc_url(get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : url("img/logo.png"));

		// Category/term ordering.
		add_action('create_term', array($this, 'create_term'), 5, 3);

		// Add form.
		add_action('category_add_form_fields', array($this, 'add_category_fields'));
		add_action('category_edit_form_fields', array($this, 'edit_category_fields'), 10);
		add_action('created_term', array($this, 'save_category_fields'), 10, 3);
		add_action('edit_term', array($this, 'save_category_fields'), 10, 3);

		// Add columns.
		add_filter('manage_edit-category_columns', array($this, 'category_columns'));
		add_filter('manage_category_custom_column', array($this, 'category_column'), 10, 3);

		// Add row actions.
		add_filter('category_row_actions', array($this, 'category_row_actions'), 10, 2);
		add_filter('admin_init', array($this, 'handle_category_row_actions'));

		// Taxonomy page descriptions.
		add_action('category_pre_add_form', array($this, 'category_description'));
		add_action('after-category-table', array($this, 'category_notes'));

		// $attribute_taxonomies = wc_get_attribute_taxonomies();

		if (!empty($attribute_taxonomies)) {
			foreach ($attribute_taxonomies as $attribute) {
				add_action('pa_' . $attribute->attribute_name . '_pre_add_form', array($this, 'product_attribute_description'));
			}
		}

		// Maintain hierarchy of terms.
		add_filter('wp_terms_checklist_args', array($this, 'disable_checked_ontop'));

		// Admin footer scripts for this product categories admin screen.
		add_action('admin_footer', array($this, 'scripts_at_category_screen_footer'));
	}

	/**
	 * Order term when created (put in position 0).
	 *
	 * @param mixed  $term_id Term ID.
	 * @param mixed  $tt_id Term taxonomy ID.
	 * @param string $taxonomy Taxonomy slug.
	 */
	public function create_term($term_id, $tt_id = '', $taxonomy = '')
	{
		if ('category' !== $taxonomy) {
			return;
		}

		update_term_meta($term_id, 'order', 0);
	}

	/**
	 * Category thumbnail fields.
	 */
	public function add_category_fields()
	{
?>
		<div class="form-field term-display-type-wrap">
			<label for="display_type"><?php esc_html_e('Display type', 'woocommerce'); ?></label>
			<select id="display_type" name="display_type" class="postform">
				<option value=""><?php esc_html_e('Default', 'woocommerce'); ?></option>
				<option value="products"><?php esc_html_e('Products', 'woocommerce'); ?></option>
				<option value="subcategories"><?php esc_html_e('Subcategories', 'woocommerce'); ?></option>
				<option value="both"><?php esc_html_e('Both', 'woocommerce'); ?></option>
			</select>
		</div>
		<div class="form-field term-thumbnail-wrap">
			<label><?php esc_html_e('Thumbnail', 'woocommerce'); ?></label>
			<div id="category_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($this->placeholder_image); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="category_thumbnail_id" name="category_thumbnail_id" />
				<button type="button" class="upload_image_button button"><?php esc_html_e('Upload/Add image', 'woocommerce'); ?></button>
				<button type="button" class="remove_image_button button"><?php esc_html_e('Remove image', 'woocommerce'); ?></button>
			</div>
			<script type="text/javascript">
				// Only show the "remove image" button when needed
				if (!jQuery('#category_thumbnail_id').val()) {
					jQuery('.remove_image_button').hide();
				}

				// Uploading files
				var file_frame;

				jQuery(document).on('click', '.upload_image_button', function(event) {

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if (file_frame) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e('Choose an image', 'woocommerce'); ?>',
						button: {
							text: '<?php esc_html_e('Use image', 'woocommerce'); ?>'
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on('select', function() {
						var attachment = file_frame.state().get('selection').first().toJSON();
						var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

						jQuery('#category_thumbnail_id').val(attachment.id);
						jQuery('#category_thumbnail').find('img').attr('src', attachment_thumbnail.url);
						jQuery('.remove_image_button').show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery(document).on('click', '.remove_image_button', function() {
					jQuery('#category_thumbnail').find('img').attr('src', '<?php echo esc_js($this->placeholder_image); ?>');
					jQuery('#category_thumbnail_id').val('');
					jQuery('.remove_image_button').hide();
					return false;
				});

				jQuery(document).ajaxComplete(function(event, request, options) {
					if (request && 4 === request.readyState && 200 === request.status &&
						options.data && 0 <= options.data.indexOf('action=add-tag')) {

						var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
						if (!res || res.errors) {
							return;
						}
						// Clear Thumbnail fields on submit
						jQuery('#category_thumbnail').find('img').attr('src', '<?php echo esc_js($this->placeholder_image); ?>');
						jQuery('#category_thumbnail_id').val('');
						jQuery('.remove_image_button').hide();
						// Clear Display type field on submit
						jQuery('#display_type').val('');
						return;
					}
				});
			</script>
			<div class="clear"></div>
		</div>
	<?php
	}

	/**
	 * Edit category thumbnail field.
	 *
	 * @param mixed $term Term (category) being edited.
	 */
	public function edit_category_fields($term)
	{

		$display_type = get_term_meta($term->term_id, 'display_type', true);
		$thumbnail_id = absint(get_term_meta($term->term_id, 'thumbnail_id', true));

		if ($thumbnail_id) {
			$image = wp_get_attachment_thumb_url($thumbnail_id);
		} else {
			$image = $this->placeholder_image;
		}
	?>
		<tr class="form-field term-display-type-wrap">
			<th scope="row" valign="top"><label><?php esc_html_e('Display type', 'woocommerce'); ?></label></th>
			<td>
				<select id="display_type" name="display_type" class="postform">
					<option value="" <?php selected('', $display_type); ?>><?php esc_html_e('Default', 'woocommerce'); ?></option>
					<option value="products" <?php selected('products', $display_type); ?>><?php esc_html_e('Products', 'woocommerce'); ?></option>
					<option value="subcategories" <?php selected('subcategories', $display_type); ?>><?php esc_html_e('Subcategories', 'woocommerce'); ?></option>
					<option value="both" <?php selected('both', $display_type); ?>><?php esc_html_e('Both', 'woocommerce'); ?></option>
				</select>
			</td>
		</tr>
		<tr class="form-field term-thumbnail-wrap">
			<th scope="row" valign="top"><label><?php esc_html_e('Thumbnail', 'woocommerce'); ?></label></th>
			<td>
				<div id="category_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($image); ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="category_thumbnail_id" name="category_thumbnail_id" value="<?php echo esc_attr($thumbnail_id); ?>" />
					<button type="button" class="upload_image_button button"><?php esc_html_e('Upload/Add image', 'woocommerce'); ?></button>
					<button type="button" class="remove_image_button button"><?php esc_html_e('Remove image', 'woocommerce'); ?></button>
				</div>
				<script type="text/javascript">
					// Only show the "remove image" button when needed
					if ('0' === jQuery('#category_thumbnail_id').val()) {
						jQuery('.remove_image_button').hide();
					}

					// Uploading files
					var file_frame;

					jQuery(document).on('click', '.upload_image_button', function(event) {

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if (file_frame) {
							file_frame.open();
							return;
						}

						// Create the media frame.
						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php esc_html_e('Choose an image', 'woocommerce'); ?>',
							button: {
								text: '<?php esc_html_e('Use image', 'woocommerce'); ?>'
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame.on('select', function() {
							var attachment = file_frame.state().get('selection').first().toJSON();
							var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

							jQuery('#category_thumbnail_id').val(attachment.id);
							jQuery('#category_thumbnail').find('img').attr('src', attachment_thumbnail.url);
							jQuery('.remove_image_button').show();
						});

						// Finally, open the modal.
						file_frame.open();
					});

					jQuery(document).on('click', '.remove_image_button', function() {
						jQuery('#category_thumbnail').find('img').attr('src', '<?php echo esc_js($this->placeholder_image); ?>');
						jQuery('#category_thumbnail_id').val('');
						jQuery('.remove_image_button').hide();
						return false;
					});
				</script>
				<div class="clear"></div>
			</td>
		</tr>
	<?php
	}

	/**
	 * Save category fields
	 *
	 * @param mixed  $term_id Term ID being saved.
	 * @param mixed  $tt_id Term taxonomy ID.
	 * @param string $taxonomy Taxonomy slug.
	 */
	public function save_category_fields($term_id, $tt_id = '', $taxonomy = '')
	{
		if (isset($_POST['display_type']) && 'category' === $taxonomy) { // WPCS: CSRF ok, input var ok.
			update_term_meta($term_id, 'display_type', esc_attr($_POST['display_type'])); // WPCS: CSRF ok, sanitization ok, input var ok.
		}
		if (isset($_POST['category_thumbnail_id']) && 'category' === $taxonomy) { // WPCS: CSRF ok, input var ok.
			update_term_meta($term_id, 'thumbnail_id', absint($_POST['category_thumbnail_id'])); // WPCS: CSRF ok, input var ok.
		}
	}

	/**
	 * Description for category page to aid users.
	 */
	public function category_description()
	{
		echo wp_kses(
			wpautop(__('Product categories for your store can be managed here. To change the order of categories on the front-end you can drag and drop to sort them. To see more categories listed click the "screen options" link at the top-right of this page.', 'woocommerce')),
			array('p' => array())
		);
	}

	/**
	 * Add some notes to describe the behavior of the default category.
	 */
	public function category_notes()
	{
		$category_id   = get_option('default_category', 0);
		$category      = get_term($category_id, 'category');
		$category_name = (!$category || is_wp_error($category)) ? _x('Uncategorized', 'Default category slug', 'woocommerce') : $category->name;
	?>
		<div class="form-wrap edit-term-notes">
			<p>
				<strong><?php esc_html_e('Note:', 'woocommerce'); ?></strong><br>
				<?php
				printf(
					/* translators: %s: default category */
					esc_html__('Deleting a category does not delete the products in that category. Instead, products that were only assigned to the deleted category are set to the category %s.', 'woocommerce'),
					'<strong>' . esc_html($category_name) . '</strong>'
				);
				?>
			</p>
		</div>
<?php
	}

	/**
	 * Description for shipping class page to aid users.
	 */
	public function product_attribute_description()
	{
		echo wp_kses(
			wpautop(__('Attribute terms can be assigned to products and variations.<br/><br/><b>Note</b>: Deleting a term will remove it from all products and variations to which it has been assigned. Recreating a term will not automatically assign it back to products.', 'woocommerce')),
			array('p' => array())
		);
	}

	/**
	 * Thumbnail column added to category admin.
	 *
	 * @param mixed $columns Columns array.
	 * @return array
	 */
	public function category_columns($columns)
	{
		$new_columns = array();

		if (isset($columns['cb'])) {
			$new_columns['cb'] = $columns['cb'];
			unset($columns['cb']);
		}

		$new_columns['thumb'] = __('Image', 'woocommerce');

		$columns           = array_merge($new_columns, $columns);
		$columns['handle'] = '';

		return $columns;
	}

	/**
	 * Adjust row actions.
	 *
	 * @param array  $actions Array of actions.
	 * @param object $term Term object.
	 * @return array
	 */
	public function category_row_actions($actions, $term)
	{
		$default_category_id = absint(get_option('default_category', 0));

		if ($default_category_id !== $term->term_id && current_user_can('edit_term', $term->term_id)) {
			$actions['make_default'] = sprintf(
				'<a href="%s" aria-label="%s">%s</a>',
				wp_nonce_url('edit-tags.php?action=make_default&amp;taxonomy=category&amp;post_type=product&amp;tag_ID=' . absint($term->term_id), 'make_default_' . absint($term->term_id)),
				/* translators: %s: taxonomy term name */
				esc_attr(sprintf(__('Make &#8220;%s&#8221; the default category', 'woocommerce'), $term->name)),
				__('Make default', 'woocommerce')
			);
		}

		return $actions;
	}

	/**
	 * Handle custom row actions.
	 */
	public function handle_category_row_actions()
	{
		if (isset($_GET['action'], $_GET['tag_ID'], $_GET['_wpnonce']) && 'make_default' === $_GET['action']) { // WPCS: CSRF ok, input var ok.
			$make_default_id = absint($_GET['tag_ID']); // WPCS: Input var ok.

			if (wp_verify_nonce($_GET['_wpnonce'], 'make_default_' . $make_default_id) && current_user_can('edit_term', $make_default_id)) { // WPCS: Sanitization ok, input var ok, CSRF ok.
				update_option('default_category', $make_default_id);
			}
		}
	}

	/**
	 * Thumbnail column value added to category admin.
	 *
	 * @param string $columns Column HTML output.
	 * @param string $column Column name.
	 * @param int    $id Product ID.
	 *
	 * @return string
	 */
	public function category_column($columns, $column, $id)
	{
		if ('thumb' === $column) {
			// Prepend tooltip for default category.
			$default_category_id = absint(get_option('default_category', 0));

			$thumbnail_id = get_term_meta($id, 'thumbnail_id', true);

			if ($thumbnail_id) {
				$image = wp_get_attachment_thumb_url($thumbnail_id);
			} else {
				$image = $this->placeholder_image;
			}

			// Prevent esc_url from breaking spaces in urls for image embeds. Ref: https://core.trac.wordpress.org/ticket/23605 .
			$image    = str_replace(' ', '%20', $image);
			$columns .= '<img src="' . esc_url($image) . '" alt="' . esc_attr__('Thumbnail', 'woocommerce') . '" class="wp-post-image" height="48" width="48" />';
		}
		if ('handle' === $column) {
			$columns .= '<input type="hidden" name="term_id" value="' . esc_attr($id) . '" />';
		}
		return $columns;
	}

	/**
	 * Maintain term hierarchy when editing a product.
	 *
	 * @param  array $args Term checklist args.
	 * @return array
	 */
	public function disable_checked_ontop($args)
	{
		if (!empty($args['taxonomy']) && 'category' === $args['taxonomy']) {
			$args['checked_ontop'] = false;
		}
		return $args;
	}

	/**
	 * Admin footer scripts for the product categories admin screen
	 *
	 * @return void
	 */
	public function scripts_at_category_screen_footer()
	{
		if (!isset($_GET['taxonomy']) || 'category' !== $_GET['taxonomy']) { // WPCS: CSRF ok, input var ok.
			return;
		}
		// Ensure the tooltip is displayed when the image column is disabled on product categories.
		// wc_enqueue_js(
		// 	"(function( $ ) {
		// 		'use strict';
		// 		var category = $( 'tr#tag-" . absint($this->default_cat_id) . "' );
		// 		category.find( 'th' ).empty();
		// 		category.find( 'td.thumb span' ).detach( 'span' ).appendTo( category.find( 'th' ) );
		// 	})( jQuery );"
		// );
	}
}
