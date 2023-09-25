<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           school
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.

}

// global $woocommerce;
// $products = $woocommerce->cart->get_cart();

$categories = get_the_posts([
    'post_type' => 'page',
    'post_status' => 'publish',
    // 'post_name__in' => ['man', 'woman', 'kids'], // Replace with your slugs
]);

// echo "<pre>";
// print_r($categories->posts);
// echo "</pre>";

// die;

?>

<?php get_header(); ?>

<main id="main" class="<?php echo school_container("py-10 not-prose"); ?>">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsum, eum accusamus magni autem aliquid expedita pariatur quasi quam laudantium exercitationem nam natus id eligendi nihil eaque at aut mollitia.
</main>

<?php get_footer(); ?>