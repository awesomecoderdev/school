<?php if (isset($args)) : ?>
    <!-- start single level menu -->
    <a <?php echo $attributes; ?> class="bg-zinc-100/15 hover:bg-zinc-100/50 rounded-lg relative px-2.5 py-2 text-sm font-medium leading-5 text-zinc-600 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white group <?php echo $depth > 0 ? "block": "flex" ?> items-center justify-start transition-colors focus:outline-none disabled:pointer-events-none disabled:opacity-50 <?php echo $nav_menu_link_class; ?> ">
        <?php echo $args->link_before . __(apply_filters('the_title', $item->title, $item->ID), "school") . $args->link_after; ?>
    <!-- end single level menu -->
    </a>
    <?php echo $args->after; ?>
<?php endif; ?>
