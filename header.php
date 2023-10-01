<?php

/**
 * The header of the Theme.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           school
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
<!doctype html>
<html <?php language_attributes(); ?> class="darks">

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- Trigger the custom action hook -->
    <?php do_action('customizer_theme_colors'); ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class("bg-white dark:bg-dark"); ?>>
    <?php wp_body_open(); ?>

    <!-- start:header -->
    <header class="relative lg:px-4 sm:px-5 xs:px-5 px-4 mx-auto max-w-6xl border bg-white" id="header">
        <style>
            .slider .slider-item {
                visibility: hidden;
                opacity: 0;
                transition: opacity 2s ease, visibility 0s ease 2s;
            }

            .slider .slider-item.active {
                visibility: visible;
                opacity: 1;
                transition: opacity 2s ease;
            }
        </style>
        <div class="slider relative w-full h-56">
            <?php foreach (get_school_banners() as $key => $banner) : ?>
                <div class="<?php echo $key == 0 ? "active" : "" ?> slider-item transition-opacity duration-300 ease-in-out absolute h-56 w-full bg-img-cover bg-center" style="background: url(<?php echo $banner; ?>);"> </div>
            <?php endforeach; ?>

            <div class="relative h-full w-full z-10 flex items-center ">
                <div class="relative px-10">
                    <a href="<?php echo site_url("/") ?>">
                        <?php if ($logo_id = get_theme_mod('custom_logo')) : ?>
                            <?php $logo_url = wp_get_attachment_image_url($logo_id, 'full'); ?>
                            <img class="h-24 w-24" src="<?php echo  $logo_url ?>" alt="<?php echo bloginfo("title") ?>">
                        <?php else : ?>
                            <img class="h-24 w-24" src="<?php echo url("img/logo.png") ?>" alt="<?php echo bloginfo("title") ?>">
                        <?php endif; ?>
                    </a>
                    <h1 class="text-white text-3xl font-semibold [text-shadow:_2px_2px_2px_#000000,_3px_3px_2px_#000000;]"><?php bloginfo("title") ?></h1>
                    <h2 class="text-white text-2xl font-semibold [text-shadow:_2px_2px_2px_#000000,_3px_3px_2px_#000000;]"><?php echo get_option('school_address', "কাজীপুর, সিরাজগঞ্জ") ?></h2>
                </div>
            </div>
        </div>
        <div class="relative md:block hidden py-6 ">
            <div class="relative h-auto w-full">
                <nav class="w-full relative flex justify-start">
                    <?php
                    wp_nav_menu( // show nav
                        array(
                            'container'            => false,
                            // 'items_wrap'           => '%3$s',
                            'theme_location'       => has_nav_menu('primary') ? 'primary' : null,
                            'menu_class'            => "relative flex space-x-4 text-slate-600 dark:text-white",
                            'walker'               => new \AwesomeCoder\School\SchoolPrimaryMenu(),
                        )
                    );
                    ?>
                </nav>
            </div>
        </div>


    </header>
    <!-- end:header -->