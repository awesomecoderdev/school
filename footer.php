<?php

/**
 * The footer of the Theme.
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


<!-- start:footer -->
<footer id="footer" class="relative lg:px-4 sm:px-5 xs:px-5 px-4 mx-auto max-w-6xl border-x bg-white overflow-hidden">
    <img class="w-full h-auto py-4 lg:scale-[103%] md:scale-[106%] scale-[112%]" src="<?php echo url("img/footer.png"); ?>" alt="">
    <div class="relative w-full py-3 flex justify-between items-center">
        <div class="relative">
            <p class="text-sm font-normal"><span class="font-medium">Last update:</span> <?php echo date("Y-m-d", strtotime("-1 months ago")) ?></p>

        </div>
        <div class="relative w-full flex justify-end max-w-xs">
            <div class="relative">
                <p class="text-xs p-0 m-0">
                    Developed By
                    <a class="text-xs font-semibold text-indigo-500" href="https://awesomecoder.dev">Mohammad Ibrahim</a>
                </p>
            </div>
        </div>
    </div>
    <div class="w-full bg-primary-500 lg:scale-[103%] md:scale-[106%] scale-[112%] py-1.5 px-3 flex md:justify-end justify-between space-x-2.5">
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
</footer>
<!-- end:footer -->

<?php wp_footer(); ?>
<script>

</script>
</body>

</html>