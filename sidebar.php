<?php

/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @link              https://awesomecoder.org/
 * @since             1.0.0
 * @package           ac_restaurant
 *
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<?php if (is_active_sidebar('school_sidebar')) : ?>
	<ul id="sidebar" class="relative grid lg:grid-cols-1 md:grid-cols-2 grid-cols-1 gap-6">
		<?php dynamic_sidebar('school_sidebar'); ?>
	</ul>
<?php endif; ?>
