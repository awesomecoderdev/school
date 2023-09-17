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
                    <ul class="relative flex space-x-4 text-slate-600 dark:text-white">
                        <li>
                            <a href="<?php echo site_url("/my-account") ?>" class="flex justify-center items-center <?php echo school_path("my-account") ? "text-primary-500 dark:text-white" : "" ?>">
                                <svg class="mr-1.5" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                account
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/wishlist") ?>" class="flex justify-center items-center <?php echo school_path("wishlist") ? "text-primary-500 dark:text-white" : "" ?>">
                                <svg class="mr-1.5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 20.355C11.9013 20.3556 11.8034 20.3367 11.7121 20.2993C11.6207 20.262 11.5376 20.207 11.4675 20.1375L4.57499 13.245C3.78931 12.4583 3.25438 11.4565 3.03775 10.366C2.82111 9.27553 2.9325 8.1453 3.35783 7.11807C3.78317 6.09085 4.50338 5.21271 5.42749 4.59456C6.35161 3.97641 7.43819 3.64598 8.54999 3.645C9.79938 3.64019 11.0142 4.05483 12 4.8225C13.0833 3.98581 14.4339 3.57163 15.8 3.65718C17.1661 3.74274 18.4545 4.32219 19.425 5.2875C20.477 6.34444 21.0676 7.775 21.0676 9.26625C21.0676 10.7575 20.477 12.1881 19.425 13.245L12.5325 20.1375C12.4624 20.207 12.3793 20.262 12.2879 20.2993C12.1965 20.3367 12.0987 20.3556 12 20.355ZM8.54999 5.145C8.00797 5.14317 7.47099 5.24897 6.97017 5.45625C6.46936 5.66352 6.01467 5.96816 5.63249 6.3525C4.86214 7.12808 4.4298 8.17686 4.4298 9.27C4.4298 10.3631 4.86214 11.4119 5.63249 12.1875L12 18.5475L18.3675 12.1875C19.1378 11.4119 19.5702 10.3631 19.5702 9.27C19.5702 8.17686 19.1378 7.12808 18.3675 6.3525C17.9844 5.96925 17.5296 5.66523 17.029 5.45781C16.5284 5.25039 15.9919 5.14363 15.45 5.14363C14.9081 5.14363 14.3716 5.25039 13.871 5.45781C13.3704 5.66523 12.9156 5.96925 12.5325 6.3525C12.4628 6.4228 12.3798 6.47859 12.2884 6.51667C12.197 6.55474 12.099 6.57435 12 6.57435C11.901 6.57435 11.8029 6.55474 11.7116 6.51667C11.6202 6.47859 11.5372 6.4228 11.4675 6.3525C11.0853 5.96816 10.6306 5.66352 10.1298 5.45625C9.62898 5.24897 9.092 5.14317 8.54999 5.145Z" fill="currentColor" />
                                </svg>
                                wishlist
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/cart") ?>" class="relative flex justify-center items-center">
                                <svg class="mr-1.5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.651 6.5984C16.651 4.21232 14.7167 2.27799 12.3307 2.27799C11.1817 2.27316 10.0781 2.72619 9.26387 3.53695C8.44968 4.3477 7.992 5.44939 7.992 6.5984M16.5137 21.5H8.16592C5.09955 21.5 2.74715 20.3924 3.41534 15.9348L4.19338 9.89359C4.60528 7.66934 6.02404 6.81808 7.26889 6.81808H17.4474C18.7105 6.81808 20.0469 7.73341 20.5229 9.89359L21.3009 15.9348C21.8684 19.889 19.5801 21.5 16.5137 21.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.296 11.102H15.251" stroke="#2D2D2D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.46604 11.102H9.42004" stroke="#2D2D2D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                bag
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


    </header>
    <!-- end:header -->