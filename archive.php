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
<main id="main" class="<?php echo school_container("py-4 not-prose"); ?>">
    <?php if (is_active_sidebar('school_sidebar')) : ?>
        <div class="relative grid items-start gap-x-4 lg:max-w-full py-5 lg:grid-cols-11 md:pt-0 md:gap-y-16 gap-y-5">
            <div id="contents" class="relative lg:overflow-x-hidden overflow-scroll [&>:first-child]:mt-0 [&>:last-child]:mb-0 space-y-5 lg:col-span-8 lg:order-first">
                <?php if (have_posts()) : ?>
                    <div class="relative grid gap-4">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="relative flex bg-zinc-50/50 p-4 shadow border border-slate-200/50">
                                <div class="relative w-24 h-24">
                                    <a class="relative w-24 h-24 block" href="<?php the_permalink(); ?>">
                                        <img class="relative w-20 h-20 rounded-full drop-shadow-lg" src="<?php echo get_the_thumbnail_url() ; ?>" alt="<?php the_title(); ?>">
                                    </a>
                                </div>
                                <div class="relative">
                                    <span class="line-clamp-1 font-semibold"><?php the_title() ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="relative w-full [&>:first-child]:mt-0 [&>:last-child]:mb-0 space-y-5 lg:col-span-3 order-first lg:sticky lg:top-6 md:relative md:top-0">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php else: ?>
        <div id="contents" class="relative lg:overflow-x-hidden overflow-scroll">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>

