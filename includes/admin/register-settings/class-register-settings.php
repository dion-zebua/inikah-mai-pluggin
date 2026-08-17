<?php

namespace Inikah_Mai\Admin\Register_Settings;

use Inikah_Mai\Admin\Register_Settings\Image;
use Inikah_Mai\Admin\Register_Settings\Login_Url;


if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

if (! class_exists('Inikah_Mai\\Admin\\Register_Settings')) {

    class Register_Settings
    {

        private function __construct()
        {
            $this->include_files();

            Image::get_instance();
            Login_Url::get_instance();
        }



        private function include_files()
        {
            require_once INIKAH_MAI__DIR_PATH . 'includes/admin/register-settings/image.php';
            require_once INIKAH_MAI__DIR_PATH . 'includes/admin/register-settings/login-url.php';
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
