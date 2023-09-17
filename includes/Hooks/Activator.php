<?php


namespace AwesomeCoder\School\Hooks;

class Activator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        add_option('school', rand(1, 2), '', 'yes');
    }
}
