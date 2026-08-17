<?php

namespace Inikah_Mai\Admin\Register_Settings;


if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

if (! class_exists('Inikah_Mai\\Admin\\Register_Settings\\Login_Url')) {

    class Login_Url
    {

        private function __construct()
        {
            $this->register_login_url_settings();
        }

        public function register_login_url_settings()
        {
            $group = 'inikah_mai_login_url_settings_group';

            register_setting($group, 'mai_login_url_permalink');
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
