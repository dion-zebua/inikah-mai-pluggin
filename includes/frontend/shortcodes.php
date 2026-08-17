<?php

namespace Inikah_Mai\FrontEnd;

if (!defined('ABSPATH')) {
    exit;
}

if (! class_exists('Inikah_Mai\\FrontEnd\\Shortcodes')) {

    class Shortcodes
    {


        private function __construct()
        {
            add_shortcode('mai_site_title', [$this, 'site_title']);
            add_shortcode('mai_site_slogan', [$this, 'site_slogan']);
            add_shortcode('mai_site_url', [$this, 'site_url']);
            add_shortcode('mai_page_url', [$this, 'page_url']);
            add_shortcode('mai_page_title', [$this, 'page_title']);
        }


        public static function get_shortcodes()
        {
            return [
                'mai_site_title' => 'Display the website title.',
                'mai_site_slogan' => 'Display the website slogan.',
                'mai_site_url' => 'Display the website URL.',
                'mai_page_url'    => 'Display the current page URL.',
                'mai_page_title' => 'Display the current page title.',
            ];
        }

        public function site_title()
        {
            return esc_html(get_bloginfo('name'));
        }
        public function site_slogan()
        {
            return esc_html(get_bloginfo('description'));
        }
        public function site_url()
        {
            return esc_url(home_url('/'));
        }
        public function page_url()
        {
            return esc_url(get_permalink());
        }
        public function page_title()
        {
            return esc_html(get_the_title());
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
