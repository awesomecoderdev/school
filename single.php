<?php

/**
 * The search page template file.
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

?>

<?php get_header(); ?>

<!-- school-contents -->
<main id="main" class="<?php echo school_container("py-10 not-prose"); ?>">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>