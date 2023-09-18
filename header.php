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
    <header class="relative" id="header">
        <div class="relative md:block hidden  py-6 ">
            <div class="relative container md:flex hidden justify-between items-center h-auto w-full mx-auto">
                <div class="w-1/2 relative flex lg:justify-between justify-start items-center space-x-4">
                    <a href="<?php echo site_url("/") ?>">
                        <?php if ($logo_id = get_theme_mod('custom_logo')) : ?>
                            <?php $logo_url = wp_get_attachment_image_url($logo_id, 'full'); ?>
                            <img class="h-auto lg:w-[120px] w-20" src="<?php echo  $logo_url ?>" alt="<?php echo bloginfo("title") ?>">

                            <!-- // 'full' is the image size; change it to match the size you need (e.g., 'thumbnail', 'medium', 'large', etc.) -->
                        <?php else : ?>
                            <img class="h-auto lg:w-[120px] w-20" src="<?php echo url("img/logo.png") ?>" alt="<?php echo bloginfo("title") ?>">
                        <?php endif; ?>
                    </a>
                </div>

                <nav class="w-1/2 relative flex justify-end">
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