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

<main id="main" class="<?php echo school_container("py-10 not-prose md:block hidden"); ?>">
    <?php $the_categories_index = 0; ?>
    <?php if ($categories->have_posts()) : ?>
        <div class="relative grid grid-cols-10 gap-5 ">
            <a href="<?php
                        echo site_url("/categories/woman")

                        //echo get_the_permalink($categories->posts[0]->ID);
                        ?>" class="relative col-span-6">
                <img class="h-full w-full hidden  bg-gray-200 bg-contain bg-center bg-no-repeat rounded-xl aspect-[4/4]" sr="<?php echo get_the_post_thumbnail_url($categories->posts[0]->ID); ?>)" src="https://images.unsplash.com/photo-1504903953708-1a3669833567?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1662&q=80">
                </img>
                <div class="relative bg-gray-200 overflow-hidden bg-img-cover bg-center bg-no-repeat rounded-xl h-full w-full aspect-[4/4]" style="background: url(https://images.unsplash.com/photo-1504903953708-1a3669833567?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1662&q=80);">
                </div>
                <h2 class="text-6xl text-white absolute bottom-[10%] left-1/2 transform translate-x-[-50%] font-semibold"><?php echo get_the_title($categories->posts[0]->ID) ?></h2>
            </a>
            <div class="relative col-span-4 h-full w-full">
                <div class="relative grid gap-5">
                    <a class="relative" href="<?php
                                                echo site_url("/categories/man")

                                                //echo get_the_permalink($categories->posts[1]->ID);
                                                ?>">
                        <img class="h-full hidden w-full bg-gray-200 bg-contain bg-center bg-no-repeat rounded-xl aspect-[4/3]" sr="<?php echo get_the_post_thumbnail_url($categories->posts[1]->ID); ?>)" src="https://plus.unsplash.com/premium_photo-1672857822411-ad82b8180078?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2787&q=80">
                        </img>
                        <div class="relative bg-gray-200 overflow-hidden bg-img-cover bg-center bg-no-repeat rounded-xl h-full w-full aspect-[4/3]" style="background: url(https://plus.unsplash.com/premium_photo-1672857822411-ad82b8180078?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2787&q=80);">
                        </div>
                        <h2 class="text-6xl text-white absolute bottom-[10%] left-1/2 transform translate-x-[-50%] font-semibold"><?php echo get_the_title($categories->posts[1]->ID) ?></h2>

                    </a>
                    <a class="relative" href="<?php
                                                echo site_url("/categories/kids")
                                                // echo get_the_permalink($categories->posts[2]->ID);

                                                ?>">
                        <img class="h-full hidden w-full bg-gray-200 bg-contain bg-center bg-no-repeat rounded-xl aspect-[4/3]" src="<?php echo get_the_post_thumbnail_url($categories->posts[2]->ID); ?>)">
                        </img>
                        <div class="relative bg-gray-200 overflow-hidden bg-img-cover bg-center bg-no-repeat rounded-xl h-full w-full aspect-[4/3]" style="background: url(https://images.unsplash.com/photo-1607453998774-d533f65dac99?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2787&q=80);">
                        </div>
                        <h2 class="text-6xl text-white absolute bottom-[10%] left-1/2 transform translate-x-[-50%] font-semibold"><?php echo get_the_title($categories->posts[2]->ID) ?></h2>
                    </a>

                </div>
            </div>
        </div>

        <!-- end of the loop -->
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</main>



<section class="relative pt-4 md:hidden">
    <div class="relative">
        <img class="h-full w-full  bg-gray-200 bg-contain bg-center bg-no-repeat aspect-[6/2]" src="<?php echo url("img/category/banner.png"); ?>)">
        </img>
    </div>

    <div class="relative flex justify-between items-center p-4">
        <h2 class="font-semibold"><?php _e("Explore Categories", "school"); ?></h2>

        <a class="text-primary-500 flex items-center space-x-2" href="<?php echo site_url("/categories"); ?>">
            <?php _e("View All", "school"); ?>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.8299 11.2899L10.5899 7.04995C10.497 6.95622 10.3864 6.88183 10.2645 6.83106C10.1427 6.78029 10.012 6.75415 9.87994 6.75415C9.74793 6.75415 9.61723 6.78029 9.49537 6.83106C9.37351 6.88183 9.26291 6.95622 9.16994 7.04995C8.98369 7.23731 8.87915 7.49076 8.87915 7.75495C8.87915 8.01913 8.98369 8.27259 9.16994 8.45995L12.7099 11.9999L9.16994 15.5399C8.98369 15.7273 8.87915 15.9808 8.87915 16.2449C8.87915 16.5091 8.98369 16.7626 9.16994 16.9499C9.26338 17.0426 9.3742 17.116 9.49604 17.1657C9.61787 17.2155 9.74834 17.2407 9.87994 17.2399C10.0115 17.2407 10.142 17.2155 10.2638 17.1657C10.3857 17.116 10.4965 17.0426 10.5899 16.9499L14.8299 12.7099C14.9237 12.617 14.9981 12.5064 15.0488 12.3845C15.0996 12.2627 15.1257 12.132 15.1257 11.9999C15.1257 11.8679 15.0996 11.7372 15.0488 11.6154C14.9981 11.4935 14.9237 11.3829 14.8299 11.2899Z" fill="currentColor" />
            </svg>
        </a>
    </div>

    <div class="relative grid grid-cols-4 px-4 gap-4">
        <?php foreach (get_the_categories(["number" => 8]) as $key => $category) : ?>
            <a class="relative flex justify-center items-center flex-col" href="<?php echo get_term_link($category); ?>">
                <img class="rounded-full h-14 w-14 bg-gray-100 shadow" src="<?php echo get_the_categories_image($category->term_id) ?>" alt="">
                <span class="truncate w-16 text-center"><?php echo $category->name; ?></span>
            </a>
        <?php endforeach; ?>
    </div>

</section>



<?php get_footer(); ?>