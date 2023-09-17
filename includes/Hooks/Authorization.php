<?php

namespace AwesomeCoder\School\Hooks;

class Authorization
{
    /**
     * The array of error registered with WordPress.
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $error    The error registered with WordPress to fire when the login errors.
     */
    public $error = null;

    /**
     * The array of page_id registered with WordPress.
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $page_id    The error registered with WordPress to fire when the page_id page.
     */
    public $page;

    /**
     * The array of page_id registered with WordPress.
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $page_id    The error registered with WordPress to fire when the page_id page.
     */
    public $client;

    /**
     * The array of page_id registered with WordPress.
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $page_id    The error registered with WordPress to fire when the page_id page.
     */
    public $redirect_uri;

    /**
     * The instacne of the woocommerce.
     *
     * @since    1.0.0
     * @access   private
     * @var      bool    $instance    The instacne of the woocommerce.
     */
    private $instance = false;

    /**
     * Define the core functionality of the woocommerce.
     *
     * Check woocommerce activated or not.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        add_action('init', [$this, 'init']);
        // add_action('template_redirect', [$this, 'redirect_to']);
    }

    /**
     *  It is the shortcode functions of the template
     *
     * It will reutn the search box on a page
     *
     */
    public function init()
    {
        // redirect back to the example
        $url = filter_var($this->redirect_uri, FILTER_SANITIZE_URL);
        exit(wp_redirect($url));
        // throw $th;
    }

    // /**
    //  *  It is the shortcode functions of the template
    //  *
    //  * It will reutn the search box on a page
    //  *
    //  */
    // public function shortcode($atts = array(), $content = null, $tag = '')
    // {
    //     $auth = shortcode_atts(array(
    //         'page' => "filter",
    //     ), $atts);

    //     ob_start();
    //     include_once . 'frontend/views/shortcode/filter.php';
    //     $output = ob_get_contents();
    //     ob_end_clean();
    //     return $output;
    // }

    /**
     *  It is the shortcode functions of the template
     *
     * It will reutn the search box on a page
     *
     */
    public function redirect_to()
    {
        $url = filter_var($this->redirect_uri, FILTER_SANITIZE_URL);
        exit(wp_redirect($url));
    }
}

new Authorization();
