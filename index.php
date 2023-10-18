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

// $cat = get_the_posts([
//     'post_type' => 'page',
//     'post_status' => 'publish',
// 'post_name__in' => ['man', 'woman', 'kids'], // Replace with your slugs
// ]);

// echo "<pre>";
// print_r($cat->posts);
// echo "</pre>";

// die;

?>

<?php get_header(); ?>

<!-- school-contents -->
<main id="main" class="<?php echo school_container("py-4 not-prose"); ?>">
    <?php if (is_active_sidebar('school_sidebar')) : ?>
        <div class="relative grid items-start gap-x-4 lg:max-w-full py-5 lg:grid-cols-11 md:pt-0 md:gap-y-16 gap-y-5">
            <div id="contents" class="relative lg:overflow-x-hidden overflow-scroll [&>:first-child]:mt-0 [&>:last-child]:mb-0 space-y-5 lg:col-span-8 lg:order-first">
                <?php foreach (get_school_notices([
                    "slug" => [
                        "notices",
                        "downloads"
                    ]
                ]) as $key => $category) : ?>
                    <div class="relative flex gap-4 bg-zinc-50/50 p-4 shadow border border-slate-200/50">
                        <a class="relative w-24 h-24" href="<?php echo !is_wp_error(get_term_link($category)) ? get_term_link($category) : site_url("$category->slug"); ?>">
                            <img class="relative w-20 h-20" src="<?php echo get_the_categories_image($category->term_id); ?>" alt="<?php echo $category->name; ?>">
                        </a>
                        <?php clog($category) ?>
                        <div class="relative w-full">
                            <a href="<?php echo !is_wp_error(get_term_link($category)) ? get_term_link($category) : site_url("$category->slug") ?>" class="font-semibold  text-2xl"> <span class="text-zinc-800"><?php echo $category->name; ?></span></a>
                            <div class="relative grid w-full">
                                <?php $cat_posts = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5, 'tax_query' => [['taxonomy' => 'category', 'field' => 'id', 'terms' => $category->term_id]]]) ?>
                                <?php if ($cat_posts->have_posts()) : ?>
                                    <?php while ($cat_posts->have_posts()) : $cat_posts->the_post(); ?>
                                        <a class="relative group w-full flex items-center gap-1.5 " href="<?php the_permalink(); ?>">
                                            <svg viewBox="0 0 3 6" class="ml-3 w-auto h-1.5 overflow-visible inline text-red-400">
                                                <path d="M0 0L3 3L0 6" fill="none" stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <span class="text-sm font-semibold line-clamp-1 text-zinc-800 group-hover:text-primary-600 hover:text-primary-500">
                                                <?php the_title(); ?>
                                            </span>
                                        </a>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                            </div>

                            <a class="relative  flex justify-end" href="<?php echo !is_wp_error(get_term_link($category)) ? get_term_link($category) : site_url("$category->slug"); ?>">
                                <span class="text-xs font-semibold px-2 py-0.5 shadow line-clamp-1 bg-zinc-100 border border-slate-200/50 text-zinc-800 group-hover:text-primary-600 hover:text-primary-500">
                                    <?php _e("View all", "school"); ?>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="relative grid md:grid-cols-2 grid-cols-1 gap-4">
                    <?php foreach (get_school_notices([
                        "number" => 20
                    ]) as $key => $category) : ?>
                        <?php if (!in_array($category->slug, [
                            "notices",
                            "downloads"
                        ])) : ?>
                            <div class="relative min-h-[12rem] flex gap-4 bg-zinc-50/50 p-4 shadow border border-slate-200/50">
                                <a class="relative w-24 h-24" href="<?php echo !is_wp_error(get_term_link($category)) ? get_term_link($category) : site_url("$category->slug"); ?>">
                                    <img class="relative w-20 h-20" src="<?php echo get_the_categories_image($category->term_id); ?>" alt="<?php echo $category->name; ?>">
                                </a>
                                <?php clog($category) ?>
                                <div class="relative w-full">
                                    <a href="<?php echo !is_wp_error(get_term_link($category)) ? get_term_link($category) : site_url("$category->slug") ?>" class="font-semibold  text-2xl"> <span class="text-zinc-800"><?php echo $category->name; ?></span></a>
                                    <div class="relative grid w-full pb-10">
                                        <?php $cat_posts = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5, 'tax_query' => [['taxonomy' => 'category', 'field' => 'id', 'terms' => $category->term_id]]]) ?>
                                        <?php if ($cat_posts->have_posts()) : ?>
                                            <?php while ($cat_posts->have_posts()) : $cat_posts->the_post(); ?>
                                                <a class="relative group w-full flex items-center gap-1.5 " href="<?php the_permalink(); ?>">
                                                    <svg viewBox="0 0 3 6" class="ml-3 w-auto h-1.5 overflow-visible inline text-red-400">
                                                        <path d="M0 0L3 3L0 6" fill="none" stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-sm font-semibold line-clamp-1 text-zinc-800 group-hover:text-primary-600 hover:text-primary-500">
                                                        <?php the_title(); ?>
                                                    </span>
                                                </a>
                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="absolute bottom-0 w-full">
                                        <a class=" flex justify-end" href="<?php echo !is_wp_error(get_term_link($category)) ? get_term_link($category) : site_url("$category->slug"); ?>">
                                            <span class="text-xs font-semibold px-2 py-0.5 shadow line-clamp-1 bg-zinc-100 border border-slate-200/50 text-zinc-800 group-hover:text-primary-600 hover:text-primary-500">
                                                <?php _e("View all", "school"); ?>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </div>
            <div class="relative w-full [&>:first-child]:mt-0 [&>:last-child]:mb-0 space-y-5 lg:col-span-3 order-first lg:sticky lg:top-6 md:relative md:top-0">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php else : ?>
        <div id="contents" class="relative lg:overflow-x-hidden overflow-scroll">
            <?php foreach (get_school_notices() as $key => $category) : ?>
                <div class="relative flex gap-4 bg-zinc-50 p-4 shadow border border-slate-200/50">
                    <img class="relative w-20 h-20" src="<?php echo get_the_categories_image($category->term_id); ?>" alt="<?php echo $category->name; ?>">
                    <?php clog($category) ?>
                    <div class="relative w-full">
                        <a href="<?php echo !is_wp_error(get_term_link($category)) ? get_term_link($category) : site_url("$category->slug") ?>" class="font-semibold  text-xl"> <span class="text-zinc-800"><?php echo $category->name; ?></span></a>
                        <div class="relative grid w-full">
                            <?php $cat_posts = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5, 'tax_query' => [['taxonomy' => 'category', 'field' => 'id', 'terms' => $category->term_id]]]) ?>
                            <?php if ($cat_posts->have_posts()) : ?>
                                <?php while ($cat_posts->have_posts()) : $cat_posts->the_post(); ?>
                                    <a class="relative group w-full flex items-center gap-1.5 " href="<?php the_permalink(); ?>">
                                        <svg viewBox="0 0 3 6" class="ml-3 w-auto h-1.5 overflow-visible inline text-red-400">
                                            <path d="M0 0L3 3L0 6" fill="none" stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <span class="text-xs font-semibold line-clamp-1 text-zinc-800 group-hover:text-primary-600 hover:text-primary-500">
                                            <?php the_title(); ?>
                                        </span>
                                    </a>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>