<style>
    :root {
        <?php foreach (get_school_theme_colors() as $key => $color) : ?>--primary-<?php echo "$key"; ?>: <?php echo get_theme_mod("color-$key", $color); ?>;
        <?php endforeach; ?>
    }
</style>