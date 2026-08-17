<?php

namespace Inikah_Mai\FrontEnd;

use Inikah_Mai\FrontEnd\Render_Image;
use Inikah_Mai\FrontEnd\Apply_Image;
use Inikah_Mai\FrontEnd\Login_Url;
use Inikah_Mai\FrontEnd\Shortcodes;

if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

if (! class_exists('Inikah_Mai\\FrontEnd\\Mai_FrontEnd')) {

    class Mai_FrontEnd
    {
        private function __construct()
        {
            $this->include_files();

            Render_Image::get_instance();
            Apply_Image::get_instance();
            Login_Url::get_instance();
            Shortcodes::get_instance();
        }



        private function include_files()
        {
            require_once INIKAH_MAI__DIR_PATH . 'includes/frontend/render-image.php';
            require_once INIKAH_MAI__DIR_PATH . 'includes/frontend/apply-image.php';
            require_once INIKAH_MAI__DIR_PATH . 'includes/frontend/login-url.php';
            require_once INIKAH_MAI__DIR_PATH . 'includes/frontend/shortcodes.php';
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
