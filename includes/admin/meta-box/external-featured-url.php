<?php

namespace Inikah_Mai\Admin\Meta_Box;

if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

class External_Featured_Url
{
    private array $enabled_post_types;

    private function __construct()
    {
        $this->enabled_post_types = (array) get_option('mai_image_featured_post_types', []);

        add_action('add_meta_boxes', function () {

            $screen = get_current_screen();

            if (!$screen || !in_array($screen->post_type, $this->enabled_post_types)) {
                return;
            }

            add_meta_box(
                'external_featured_url',
                'External Featured URL',
                [$this, 'input_external_featured_url'],
                null,
                'side',
                'high'
            );
        });

        add_action(
            'save_post',
            [$this, 'save_external_featured_url']
        );
    }


    public function input_external_featured_url(\WP_Post $post)
    {
        wp_nonce_field(
            'save_external_featured_url',
            'external_featured_url_nonce'
        );

        $external_featured_url = get_post_meta(
            $post->ID,
            '_mai_external_featured_url',
            true
        );

        echo '
        <input
            type="url"
            name="external_featured_url"
            value="' . esc_attr($external_featured_url) . '"
            placeholder="https://example.com/image.jpg"
            style="width:100%;">';
    }

    public function save_external_featured_url(int $post_id)
    {
        if (
            !isset($_POST['external_featured_url_nonce']) ||
            !wp_verify_nonce(
                $_POST['external_featured_url_nonce'],
                'save_external_featured_url'
            )
        ) {
            return;
        }


        if (
            defined('DOING_AUTOSAVE') &&
            DOING_AUTOSAVE
        ) {
            return;
        }


        if (
            !current_user_can(
                'edit_post',
                $post_id
            )
        ) {
            return;
        }


        if (!isset($_POST['external_featured_url'])) {
            return;
        }


        $url = esc_url_raw(
            $_POST['external_featured_url']
        );


        update_post_meta(
            $post_id,
            '_mai_external_featured_url',
            $url
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
