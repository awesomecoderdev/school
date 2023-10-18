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
    <header class="relative lg:px-4 sm:px-5 px-0 mx-auto max-w-6xl border bg-white" id="header">
        <div class="w-full bg-primary-500 mb-4 lg:scale-[103%] md:scale-[106%] scale-[112%] py-1.5 px-3 flex md:justify-end justify-between space-x-2.5">
            <?php if (get_option("school_address", null)) : ?>

                <p class="text-xs font-medium line-clamp-1 flex items-center space-x-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <span class="truncate  md:w-full w-40">
                        <?php echo get_option("school_address"); ?>
                    </span>
                </p>
            <?php endif; ?>

            <?php if (get_option("school_phone", null)) : ?>

                <p class="text-xs font-medium flex items-center space-x-3">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                    <?php echo get_option("school_phone") ?>
                </p>
            <?php endif; ?>
        </div>
        <div class="slider relative w-full h-56">
            <?php foreach (get_school_banners() as $key => $banner) : ?>
                <div class="<?php echo $key == 0 ? "active" : "" ?> slider-item transition-opacity duration-300 ease-in-out absolute h-56 w-full bg-img-cover bg-center" style="background: url(<?php echo $banner; ?>);"> </div>
            <?php endforeach; ?>

            <div class="relative h-full w-full z-10 flex items-center ">

                <div id="hamburger" class="absolute md:hidden flex items-center justify-center rounded-lg right-5 top-5 bg-white z-10 h-10 w-10">
                    <button type="button" id="trigger-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="open = true">
                        <svg class="h-6 w-6 pointer-events-none" id="open-menu" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                        </svg>
                        <svg class="h-6 w-6 pointer-events-none hidden" id="close-menu" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="relative lg:px-8 md:px-6 px-4">
                    <a href="<?php echo site_url("/") ?>" class="block md:pb-3 pb-4">
                        <?php if ($logo_id = get_theme_mod('custom_logo')) : ?>
                            <?php $logo_url = wp_get_attachment_image_url($logo_id, 'full'); ?>
                            <img class="md:h-24 h-20 md:w-24 w-20 rounded-full" src="<?php echo  $logo_url ?>" alt="<?php echo bloginfo("title") ?>">
                        <?php else : ?>
                            <img class="md:h-24 h-20 md:w-24 w-20 rounded-full" src="<?php echo url("img/logo.png") ?>" alt="<?php echo bloginfo("title") ?>">
                        <?php endif; ?>
                    </a>
                    <h1 class="text-white lg:text-3xl md:text-2xl text-xl font-semibold [text-shadow:_2px_2px_2px_#000000,_3px_3px_2px_#000000;]"><?php bloginfo("title") ?></h1>
                    <h2 class="text-white lg:text-2xl md:text-xl text-lg font-semibold [text-shadow:_2px_2px_2px_#000000,_3px_3px_2px_#000000;]"><?php echo get_option('school_address', "কাজীপুর, সিরাজগঞ্জ") ?></h2>
                </div>
            </div>

        </div>
        <div class="relative md:block hidden py-4">
            <div class="relative h-auto w-full">
                <nav class="w-full relative flex items-center justify-start space-x-2">
                    <a class="bg-slate-100 p-2 rounded font-medium leading-5 text-zinc-600 hover:text-zinc-900 " href="<?php echo site_url("/") ?>">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                    </a>
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

        <div id="mobile-navigation" class="md:hidden hidden inset-0 bg-black/30 z-20 h-screen w-screen">
            <!-- <div id="hamburger" class="absolute md:hidden flex items-center justify-center rounded-lg right-5 top-5 bg-white z-10 h-10 w-10 border border-slate-200 drop-shadow-lg">
                <button type="button" id="trigger-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="open = true">
                    <svg class="h-6 w-6 pointer-events-none" id="close-menu" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div> -->


            <div class="relative w-full h-full flex justify-end">
                <div class="relative w-full max-w-xs bg-white p-5 h-full drop-shadow-xl space-y-4">
                    <div class="flex justify-between items-center border-b border-slate-200/20">
                        <a href="<?php echo site_url("/") ?>" class="block ">
                            <?php if ($logo_id = get_theme_mod('custom_logo')) : ?>
                                <?php $logo_url = wp_get_attachment_image_url($logo_id, 'full'); ?>
                                <img class="w-10 rounded-full border border-slate-200 drop-shadow-lg" src="<?php echo  $logo_url ?>" alt="<?php echo bloginfo("title") ?>">
                            <?php else : ?>
                                <img class="w-10 rounded-full border border-slate-200 drop-shadow-lg" src="<?php echo url("img/logo.png") ?>" alt="<?php echo bloginfo("title") ?>">
                            <?php endif; ?>
                        </a>
                        <p class="text-zinc-500 text-xs px-2 truncate max-w-[12rem] font-semibold"><?php bloginfo("title") ?></p>
                        <div id="hamburger" class="md:hidden flex items-center justify-center rounded-lg right-5 top-5 bg-white z-10 h-10 w-10 border border-slate-200 drop-shadow-lg">
                            <button type="button" id="trigger-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="open = true">
                                <svg class="h-6 w-6 pointer-events-none" id="close-menu" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <nav class="w-full relative h-full ">
                        <?php
                        wp_nav_menu( // show nav
                            array(
                                'container'            => false,
                                // 'items_wrap'           => '%3$s',
                                'theme_location'       => has_nav_menu('primary') ? 'primary' : null,
                                'menu_class'            => "relative h-full space-y-4 text-slate-600 dark:text-white overflow-scroll no-scrollbar ",
                                'walker'               => new \AwesomeCoder\School\SchoolPrimaryMobileMenu(),
                            )
                        );
                        ?>
                    </nav>
                </div>
            </div>
        </div>

    </header>
    <!-- end:header -->