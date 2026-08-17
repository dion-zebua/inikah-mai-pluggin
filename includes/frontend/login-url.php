<?php

namespace Inikah_Mai\FrontEnd;

if (!defined('ABSPATH')) {
    exit;
}


define('CUSTOM_LOGIN_SLUG', 'masuk'); // <-- Ganti di sini
if (! class_exists('Inikah_Mai\\FrontEnd\\Login_Url')) {

    class Login_Url
    {

        private String $login_permalink = '';

        public function __construct()
        {

            $this->login_permalink = get_option('mai_login_url_permalink', '');

            if (!empty($this->login_permalink)) {
                add_filter('site_url', [$this, 'custom_login_site_url'], 12, 4);
                add_action('init', [$this, 'custom_login_page'], 11);
                add_action('login_init', [$this, 'block_wp_login_as_404'], 14);
            }
        }

        public function custom_login_site_url($url, $path, $scheme, $blog_id)
        {
            if (strpos($path, 'wp-login.php') === false) {
                return $url;
            }


            $request_uri = $_SERVER['REQUEST_URI'] ?? '';
            $current_path = trim(parse_url($request_uri, PHP_URL_PATH), '/');
            if (
                ($current_path === 'wp-admin' || strpos($current_path, 'wp-admin/') === 0)
                && !is_user_logged_in()
            ) {
                return $url;
            }

            $custom_url = home_url(
                '/' . trim($this->login_permalink, '/') . '/'
            );

            $query = parse_url($url, PHP_URL_QUERY);

            if (!empty($query)) {
                parse_str($query, $args);

                $custom_url = add_query_arg(
                    $args,
                    $custom_url
                );
            }

            return $custom_url;
        }


        public function custom_login_page()
        {
            $request_uri = isset($_SERVER['REQUEST_URI'])
                ? $_SERVER['REQUEST_URI']
                : '';

            $path = trim(
                parse_url($request_uri, PHP_URL_PATH),
                '/'
            );

            if ($path !== trim($this->login_permalink, '/')) {
                return;
            }

            global $user_login, $error, $interim_login, $action;

            $action = isset($_REQUEST['action'])
                ? sanitize_key($_REQUEST['action'])
                : 'login';

            if (is_user_logged_in() && $action !== 'logout') {
                wp_safe_redirect(admin_url());
                exit;
            }

            $user_login    = '';
            $error         = '';
            $interim_login = false;

            $_SERVER['PHP_SELF'] = '/wp-login.php';

            require_once ABSPATH . 'wp-login.php';

            exit;
        }



        public function block_wp_login_as_404()
        {

            global $action;

            if (is_user_logged_in() && $action !== 'logout') {
                wp_safe_redirect(admin_url());
                exit;
            }

            $request_uri = $_SERVER['REQUEST_URI'] ?? '';

            $path = trim(
                parse_url($request_uri, PHP_URL_PATH),
                '/'
            );

            if ($path !== 'wp-login.php') {
                return;
            }

            status_header(404);
            nocache_headers();

            $template = get_404_template();

            if ($template) {
                include $template;
            } else {
                wp_die(
                    'Halaman tidak ditemukan.',
                    '404',
                    [
                        'response' => 404,
                    ]
                );
            }

            exit;
        }





        public static function get_instance()
        {
            static $instance = null;

            if (is_null($instance)) {
                $instance = new self();
            }

            return $instance;
        }
    }
}
