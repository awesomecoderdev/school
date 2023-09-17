<style>
    :root {
        <?php foreach (get_school_theme_colors() as $key => $color) : ?><?php echo "--primary-$key : $color;"; ?><?php endforeach; ?>
    }
</style>