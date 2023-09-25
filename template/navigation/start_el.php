

<?php if (($depth == 0) && $args->has_children) : ?>
    <!-- start multiple level menu -->
    <button class="group flex items-center text-sm font-medium leading-5 justify-center transition-colors focus:outline-none disabled:pointer-events-none disabled:opacity-50 group">
        <a <?php echo $attributes; ?> class="relative px-2.5 py-2 text-sm font-medium leading-5 text-zinc-600 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white group inline-flex items-center justify-center transition-colors focus:outline-none disabled:pointer-events-none disabled:opacity-50 <?php echo $nav_menu_link_class; ?>">
            <?php echo $args->link_before . __(apply_filters('the_title', $item->title, $item->ID), "school") . $args->link_after; ?>
        </a>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="relative top-[1px] ml-1 h-3 w-3 transition duration-200 group-data-[state=open]:rotate-180" aria-hidden="true">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>

<?php else : ?>
    <!-- start single level menu -->
      <a <?php echo $attributes; ?> class="relative px-2.5 py-2 text-sm font-medium leading-5 text-zinc-600 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white group <?php echo $depth > 0 ? "block": "flex" ?> items-center justify-center transition-colors focus:outline-none disabled:pointer-events-none disabled:opacity-50 <?php echo $nav_menu_link_class; ?>">
            <?php echo $args->link_before . __(apply_filters('the_title', $item->title, $item->ID), "school") . $args->link_after; ?>
<?php endif; ?>


<?php if (($depth == 0 || 1) && $args->has_children) : ?>
    </button>
    <!-- end close multiple level menu -->
<?php else : ?>
    </a>
    <!-- end close single level menu -->
<?php endif; ?>

<?php echo $args->after; ?>


