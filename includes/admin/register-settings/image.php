<?php

namespace Inikah_Mai\Admin\Register_Settings;


if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

if (! class_exists('Inikah_Mai\\Admin\\Register_Settings\\Image')) {

    class Image
    {

        private function __construct()
        {
            $this->register_image_settings();
        }

        public function register_image_settings()
        {
            $group = 'inikah_mai_image_settings_group';

            register_setting($group, 'mai_image_permalink');
            register_setting($group, 'mai_image_default_bg');
            register_setting($group, 'mai_image_font_size');
            register_setting($group, 'mai_image_text_align');
            register_setting($group, 'mai_image_font_weight');
            register_setting($group, 'mai_image_line_height');
            register_setting($group, 'mai_image_text_color');

            register_setting($group, 'mai_image_featured_post_types', [
                'type'              => 'array',
                'sanitize_callback' => function ($value) {
                    return array_map('sanitize_key', (array) $value);
                },
                'default' => [],
            ]);
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
