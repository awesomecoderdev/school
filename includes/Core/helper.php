<?php

/**
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           school
 *
 *
 * ======================================================================================
 * 		The Core Function of Helpers
 * ======================================================================================                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */

use AwesomeCoder\School\Core\School;

if (!class_exists("School")) {
    require __DIR__ . "/School.php";
}


/**
 * The loader of the Theme.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('school')) {
    function school()
    {
        $instance = new School();
        return $instance;
    }
}


/**
 * The loader of the Theme.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('school_version')) {
    function school_version($file, $version)
    {
        if ($file && file_exists(get_template_directory("$file"))) {
            $version = filemtime(get_template_directory("$file"));
        }
        return $version;
    }
}



/**
 * The url builder.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string|null  $path
     * @param  mixed  $parameters
     */
    function url($path = null, $parameters = [])
    {
        $params = http_build_query($parameters);

        if (!is_null($path)) {
            if (defined("SCHOOL_THEME_URL")) {
                $path = SCHOOL_THEME_URL . "assets/$path";
            } else {
                $path = "wp-content/themes/school/$path";
            }
        } else {
            $path = "wp-content/themes/school/";
        }

        if (strpos($path, "?") !== false) {
            $path = "$path&";
        } else {
            $path = $params ? "$path?" : $path;
        }

        return $path . $params;
    }
}


/**
 * The dump and die function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('dd')) {
    /**
     * @return never
     */
    function dd(...$vars): void
    {
        if (!in_array(\PHP_SAPI, ['cli', 'phpdbg'], true) && !headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        foreach ($vars as $v) {
            echo "<pre>";
            print_r($v);
            echo "</pre>";
        }

        exit(1);
    }
}


/**
 * The school_resource function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('school_resource')) {
    function school_resource(string $view = null, bool $echo = true, array $atts = [])
    {

        $path = SCHOOL_THEME_PATH . "app/Backend/partials/$view.php";
        if ($view != null && file_exists($path)) {
            ob_start();
            include_once $path;
            $output = ob_get_contents();
            ob_end_clean();
        } else {
            $output = '<div id="schoolLoadingScreen" class="fixed inset-0 z-[99999999999] h-screen overflow-hidden block bg-white duration-500"></div>';
            // $output .= '<script>const schoolLoadingScreen=document.getElementById("schoolLoadingScreen"),plStyles=document.querySelectorAll("link"),plScripts=document.querySelectorAll("script"),plStyleTags=document.querySelectorAll("style");plStyles.forEach((e=>{const t=e.getAttribute("rel"),l=e.getAttribute("id");"stylesheet"==t&&"wp-plagiarism-backend-css"!=l&&e.remove()})),plStyleTags.forEach((e=>{e.remove()})),plScripts.forEach((e=>{e.getAttribute("src")&&e.remove()})),setTimeout((()=>{schoolLoadingScreen&&(schoolLoadingScreen.classList.add("opacity-0"),schoolLoadingScreen.remove())}),1e3);</script>';
        }

        if ($echo) {
            echo $output;
            die;
        } else {
            return $output;
            die;
        }
    }
}

/**
 * The wp_is_tablet function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('wp_is_tablet')) {
    function wp_is_tablet()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        // Check for common tablet User-Agent strings
        $tabletUserAgents = array(
            'iPad',
            'Android',
            'Kindle',
            'SamsungTablet',
            'Nexus 7',
            // Add more tablet user agents as needed
        );

        foreach ($tabletUserAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return true;
            }
        }

        return false;
    }
}

/**
 * The school_path function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('school_path')) {
    function school_path($path = false)
    {
        $url = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : (isset($_SERVER["PHP_SELF"]) ? $_SERVER["PHP_SELF"] : "/");
        $slug = explode("/", $url, 3);
        $slug = isset($slug[0]) && !empty($slug[0]) ? $slug[0] : (isset($slug[1]) && !empty($slug[1]) ? $slug[1] : $url);

        return $path ? ($slug == $path) : $slug;
    }
}


/**
 * The url_scheme function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('url_scheme')) {
    function url_scheme()
    {
        try {
            $url = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : (isset($_SERVER["PHP_SELF"]) ? $_SERVER["PHP_SELF"] : "/");
            $slug = explode("/", $url);
            $slug = array_unique($slug);
            $slug =  array_filter($slug, function ($value) {
                return !empty($value);
            });
            $slug[] = "";
            return $slug;
        } catch (\Throwable $th) {
            //throw $th;
            return [];
        }
    }
}

/**
 * The get_the_categories function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('get_the_categories')) {
    function get_the_categories($args = [])
    {
        try {
            $default = array(
                'taxonomy'      => 'category', // Taxonomy for product categories
                'title_li'      => '', // Remove the default title
                'orderby'       => 'count', // Order by the number of products
                'order'         => 'DESC',  // Descending order (most products first)
                // 'child_of'      => 0,
                // 'parent'        => 0,
                'fields'        => 'all',
                'hide_empty'    => false,
                'number'        => 4,
            );

            $args = array_merge($default, $args);

            $categories = new \WP_Term_Query($args);
            // $terms = get_terms($args);
            $terms = $categories->terms;
            // $terms = $categories;

            return $terms;
        } catch (\Throwable $th) {
            //throw $th;
            return null;
        }
    }
}





/**
 * The clog function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('clog')) {
    function clog($log = false)
    {
        echo "<script>console.log('======================================================================');</script>";
        if (is_array($log) || is_object($log)) {
            $log = json_encode($log, JSON_PRETTY_PRINT);
            echo "<script>console.log([$log]);</script>";
        } else {
            echo "<script>console.log('$log');</script>";
        }
        echo "<script>console.log('======================================================================');</script>";
    }
}

/**
 * The get_the_posts function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('get_the_posts')) {
    function get_the_posts($args = [])
    {
        try {
            $default = array(
                'post_type'         => 'post',
                'posts_per_page'    => -1, // Set to -1 to get all posts
                'order_by'          => "name",
                'order'             => "ASC"
            );

            $args = array_merge($default, $args);
            $posts = new \WP_Query($args);
            return $posts;
        } catch (\Throwable $th) {
            //throw $th;
            return [];
        }
    }
}


/**
 * The get_the_categories_image function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('get_the_categories_image')) {
    function get_the_categories_image($id = false)
    {
        if ($id) {
            $thumbnail_id = get_term_meta($id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnail_id);

            if (!empty($image)) {
                return $image;
            }
        }

        return url('img/category/school.png');
    }
}


/**
 * The school_container function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('school_container')) {
    function school_container($extra = "")
    {
        $default = "relative container prose dark:prose-invert min-h-[calc(60vh-112px)] lg:px-8 sm:px-7 xs:px-5 px-4 xl:overflow-visible overflow-hidden";

        return "$default $extra";
    }
}


/**
 * The school_response function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('school_response')) {
    function school_response(array $contents = [], $status = 200, array $headers = [])
    {
        $response = [
            "success" => true,
            "status" => $status,
            "message" => "Successfully Authorized.",
        ];

        $response = array_merge($response, $contents);

        // Set the HTTP response code
        http_response_code($status);

        // Set the response headers
        foreach ($headers as $header) {
            header($header);
        }

        // Encode the content as JSON and send it as the response body
        header('Content-Type: application/json');
        echo json_encode($response);
        wp_die();
    }
}


/**
 * The school_cart_sidebar function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('school_cart_sidebar')) {
    function school_cart_sidebar()
    {
        ob_start();
        include_once SCHOOL_THEME_PATH . "/template/section/cart/sidebar.php";
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}

/**
 * The get_school_theme_colors function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('get_school_theme_colors')) {
    function get_school_theme_colors()
    {
        $colors = [
            "50" => "#d2e0d3",
            "100" => "#c2d6c4",
            "200" => "#b6ceb7",
            "300" => "#a5bea6",
            "400" => "#a1bba2",
            "500" => "#92B193",
            "600" => "#7E9F82",
            "700" => "#6A8D72",
            "800" => "#568B61",
            "900" => "#407950",
        ];

        return $colors;
    }
}


/**
 * The school_get_contents function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('school_get_contents')) {
    function school_get_contents($path = false)
    {
        $file = SCHOOL_THEME_PATH . "$path";
        ob_start();
        if ($path && file_exists($file)) {
            require $file;
        }
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
