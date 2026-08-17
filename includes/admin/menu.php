<?php

namespace Inikah_Mai\Admin;


if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

if (! class_exists('Inikah_Mai\\Admin\\Menu')) {

    class Menu
    {

        private function __construct()
        {
            add_action('admin_menu', array($this, 'menu'));
        }

        public function menu()
        {
            add_menu_page(
                'Inikah Mai',
                'Inikah Mai',
                'manage_options',
                INIKAH_MAI_SETTINGS_SLUG,
                function () {
                    require_once INIKAH_MAI__DIR_PATH . 'includes/admin/pages/home.php';
                },
                'dashicons-superhero-alt',
                30
            );

            add_submenu_page(
                INIKAH_MAI_SETTINGS_SLUG,
                'Home',
                'Home',
                'manage_options',
                INIKAH_MAI_SETTINGS_SLUG,
                function () {
                    require_once INIKAH_MAI__DIR_PATH . 'includes/admin/pages/home.php';
                }
            );

            add_submenu_page(
                INIKAH_MAI_SETTINGS_SLUG,
                'Image',
                'Image',
                'manage_options',
                INIKAH_MAI_SETTINGS_SLUG . '-image',
                function () {
                    require_once INIKAH_MAI__DIR_PATH . 'includes/admin/pages/image.php';
                }
            );

            add_submenu_page(
                INIKAH_MAI_SETTINGS_SLUG,
                'Login Url',
                'Login Url',
                'manage_options',
                INIKAH_MAI_SETTINGS_SLUG . '-login-url',
                function () {
                    require_once INIKAH_MAI__DIR_PATH . 'includes/admin/pages/login-url.php';
                }
            );

            add_submenu_page(
                INIKAH_MAI_SETTINGS_SLUG,
                'Request Feature',
                'Request Feature',
                'manage_options',
                INIKAH_MAI_SETTINGS_SLUG . '-request-feature',
                function () {
                    wp_redirect('https://dionzebua.com');
                    exit;
                }
            );
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
