<?php

namespace Inikah_Mai\Admin;

use Inikah_Mai\Admin\Meta_Box\External_Featured_Url;
use Inikah_Mai\Admin\Menu;
use Inikah_Mai\Admin\Register_Settings\Register_Settings;


if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

if (! class_exists('Inikah_Mai\\Admin\\Mai_Admin')) {

    class Mai_Admin
    {
        private function __construct()
        {
            $this->include_files();

            Menu::get_instance();
            Register_Settings::get_instance();
            External_Featured_Url::get_instance();
        }



        private function include_files()
        {
            require_once INIKAH_MAI__DIR_PATH . 'includes/admin/meta-box/external-featured-url.php';
            require_once INIKAH_MAI__DIR_PATH . 'includes/admin/menu.php';
            require_once INIKAH_MAI__DIR_PATH . 'includes/admin/register-settings/class-register-settings.php';
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
