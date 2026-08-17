<?php

namespace Inikah_Mai\FrontEnd;

if (!defined('ABSPATH')) {
    exit;
}

if (! class_exists('Inikah_Mai\\FrontEnd\\Apply_Image')) {

    class Apply_Image
    {

        private array $enabled_post_types;

        private function __construct()
        {

            $this->enabled_post_types = (array) get_option('mai_image_featured_post_types', []);

            $this->featured_image_block();
            $this->featured_image_placeholder();
            $this->og_image();
            $this->schema_markup_image();
        }

        private function featured_image_block()
        {
            add_filter('post_thumbnail_html', function ($html, $post_id, $post_thumbnail_id, $size, $attr) {

                if (
                    !empty($html) ||
                    is_home() ||
                    is_archive() ||
                    !in_array(get_post_type(), $this->enabled_post_types) ||
                    has_post_thumbnail()
                ) {
                    return $html;
                }

                $external_url = get_post_meta(
                    $post_id,
                    '_mai_external_featured_url',
                    true
                );

                $src = home_url('/') .
                    (get_option('mai_image_permalink') ?: INIKAH_MAI__IMAGE_PERMALINK) .
                    '/' .
                    rawurlencode(get_the_title());

                if ($external_url) {
                    $src =  $external_url;
                }

                $attr = wp_parse_args($attr, [
                    'class'   => 'wp-post-image',
                    'alt'     => get_the_title(),
                    'loading' => 'lazy',
                    'fetchpriority' => 'high',
                ]);

                $attributes = '';
                foreach ($attr as $key => $value) {
                    $attributes .= sprintf(
                        ' %s="%s"',
                        esc_attr($key),
                        esc_attr($value)
                    );
                }

                return sprintf(
                    '<img src="%s"%s />',
                    esc_url($src),
                    $attributes
                );
            }, 10, 5);
        }

        private function featured_image_placeholder()
        {

            add_filter('wp_get_attachment_image_src', function ($image, $attachment_id) {

                global $post;


                if ((defined('REST_REQUEST') && REST_REQUEST) ||
                    get_post_thumbnail_id() ||
                    doing_action('wp_head') ||
                    !$post
                ) {
                    return $image;
                }

                $post_type = get_post_type(wp_get_post_parent_id($attachment_id));

                if (in_array($post_type, $this->enabled_post_types)) {

                    add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment) {

                        $attr['alt'] = get_the_title();

                        return $attr;
                    }, 10, 2);

                    $external_url = get_post_meta(
                        $post->ID,
                        '_mai_external_featured_url',
                        true
                    );

                    $image[0] = home_url('/') .
                        (get_option('mai_image_permalink') ?: INIKAH_MAI__IMAGE_PERMALINK) .
                        '/' .
                        rawurlencode(get_the_title());

                    if ($external_url) {
                        $image[0] = $external_url;
                    }
                }

                return $image;
            }, 10, 2);
        }

        private function og_image()
        {
            add_filter('wpseo_opengraph_image', function ($image) {

                global $post;

                if (
                    is_search() ||
                    is_home() ||
                    is_archive() ||
                    !in_array(get_post_type(), $this->enabled_post_types) ||
                    has_post_thumbnail() ||
                    !$post
                ) {
                    return $image;
                }


                $external_url = get_post_meta(
                    $post->ID,
                    '_mai_external_featured_url',
                    true
                );

                if ($external_url) {
                    return $external_url;
                }


                return home_url('/') .
                    (get_option('mai_image_permalink') ?: INIKAH_MAI__IMAGE_PERMALINK) .
                    '/' .
                    rawurlencode(get_the_title());
            });
        }

        private function schema_markup_image()
        {
            // woo
            add_filter('woocommerce_structured_data_product', function ($markup, $product) {


                if (
                    is_search() ||
                    is_home() ||
                    is_archive() ||
                    !in_array(get_post_type(), $this->enabled_post_types) ||
                    has_post_thumbnail()
                ) {
                    return $markup;
                }

                $markup['image'] = home_url('/') .
                    (get_option('mai_image_permalink') ?: INIKAH_MAI__IMAGE_PERMALINK) .
                    '/' .
                    rawurlencode(get_the_title());

                $external_url = get_post_meta(
                    get_the_ID(),
                    '_mai_external_featured_url',
                    true
                );


                if ($external_url) {
                    $markup['image'] = $external_url;
                }


                return $markup;
            }, 10, 2);


            // yoast
            add_filter('wpseo_schema_graph', function ($data, $context) {

                if (
                    is_search() ||
                    is_home() ||
                    is_archive() ||
                    !in_array(get_post_type(), $this->enabled_post_types) ||
                    has_post_thumbnail()
                ) {
                    return $data;
                }

                $markup['image'] = home_url('/') .
                    (get_option('mai_image_permalink') ?: INIKAH_MAI__IMAGE_PERMALINK) .
                    '/' .
                    rawurlencode(get_the_title());

                $external_url = get_post_meta(
                    get_the_ID(),
                    '_mai_external_featured_url',
                    true
                );


                if ($external_url) {
                    $markup['image'] = $external_url;
                }

                return $data;
            }, 10, 2);
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
