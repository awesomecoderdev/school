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
<footer id="footer" class="relative porse lg:px-4 sm:px-5 xs:px-5 px-4 py-5 pb-10 mx-auto max-w-6xl border-x bg-white overflow-hidden">
    <img class="w-full h-auto py-4 lg:scale-[103%] md:scale-[106%] scale-[112%]" src="<?php echo url("img/footer.png"); ?>" alt="">
    <div class="relative w-full py-3 flex justify-between items-center">
        <div class="relative">
            <p class="text-sm font-normal"><span class="font-medium">Last update:</span> <?php echo date("Y-m-d", strtotime("-1 months ago")) ?></p>

        </div>
        <div class="relative w-full flex justify-end max-w-xs">
            <div class="relative">
                <p class="lead text-xs p-0 m-0">
                    Developed By
                    <a class="text-xs font-semibold text-indigo-500" href="https://awesomecoder.dev">Mohammad Ibrahim</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- end:footer -->

<?php wp_footer(); ?>
<script>

</script>
</body>

</html>