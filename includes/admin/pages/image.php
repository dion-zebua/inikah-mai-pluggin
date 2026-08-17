<?php
if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}
?>



<div class="wrap">
    <h1>Image Option - <?= get_plugin_data(INIKAH_MAI__FILE)['Name'] ?></h1>
    <p>Setting image here!</p>

    <p>Inspired by DummyImage.com</p>

    <hr class="wp-header-end">

    <form method="post" action="options.php">
        <?php
        settings_fields('inikah_mai_image_settings_group');
        do_settings_sections('inikah-mai-image');
        ?>

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="mai_image_permalink">Permalink Structure</label>
                    </th>
                    <td>
                        <code><?php echo esc_url(home_url('/')); ?></code>
                        <input type="text" name="mai_image_permalink" id="mai_image_permalink"
                            value="<?php echo esc_attr(get_option('mai_image_permalink')); ?>"
                            class="regular-text" placeholder="<?= INIKAH_MAI__IMAGE_PERMALINK ?>">
                        <p class="description">Slug URL for img. Example:
                            <a target="_blank" href="<?php echo esc_url(home_url('/')) . (esc_attr(get_option('mai_image_permalink') ?: INIKAH_MAI__IMAGE_PERMALINK)) . '/My Title/' ?>">
                                <?php echo esc_url(home_url('/')); ?><code><?php echo esc_attr(get_option('mai_image_permalink') ?: INIKAH_MAI__IMAGE_PERMALINK); ?></code>/My Title/</a>.
                        </p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="mai_image_default_bg">Default Background Image</label>
                    </th>
                    <td>
                        <input type="url" name="mai_image_default_bg" id="mai_image_default_bg"
                            value="<?php echo esc_url(get_option('mai_image_default_bg')) ?>"
                            class="regular-text" placeholder="<?= INIKAH_MAI__DIR_URL . INIKAH_MAI__DEFAULT_BG ?>">

                        <div style="margin-top: 10px;">
                            <img loading="lazy" src="<?php echo esc_url(get_option('mai_image_default_bg') ?: INIKAH_MAI__DIR_URL . INIKAH_MAI__DEFAULT_BG); ?>"
                                style="width: 200px; aspect-ratio: 16/9; object-fit: fill; height: auto; border: 1px solid #ccc; padding: 5px; background: #fff;"
                                alt="Background Preview">
                        </div>
                    </td>
                </tr>


                <tr>
                    <th scope="row">Default Typography Styles</th>
                    <td>
                        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">

                            <div>
                                <label style="display:block; font-weight:600; margin-bottom:5px;" for="mai_image_font_size">Size</label>
                                <input type="number" name="mai_image_font_size" id="mai_image_font_size"
                                    value="<?php echo esc_attr(get_option('mai_image_font_size')); ?>" placeholder="<?= INIKAH_MAI__FONT_SIZE ?>"
                                    style="width: 70px;" min="1" max="200"> px
                            </div>

                            <div>
                                <label style="display:block; font-weight:600; margin-bottom:5px;" for="mai_image_text_align">Align</label>
                                <?php $current_align = get_option('mai_image_text_align', INIKAH_MAI__TEXT_ALIGN); ?>
                                <select name="mai_image_text_align" id="mai_image_text_align">
                                    <option value="left" <?php selected($current_align, 'left'); ?>>Left</option>
                                    <option value="center" <?php selected($current_align, 'center'); ?>>Center</option>
                                    <option value="right" <?php selected($current_align, 'right'); ?>>Right</option>
                                </select>
                            </div>

                            <div>
                                <label style="display:block; font-weight:600; margin-bottom:5px;" for="mai_image_font_weight">Weight</label>
                                <?php $current_weight = get_option('mai_image_font_weight', INIKAH_MAI__FONT_WEIGHT); ?>
                                <select name="mai_image_font_weight" id="mai_image_font_weight">
                                    <option value="normal" <?php selected($current_weight, 'normal'); ?>>Normal</option>
                                    <option value="medium" <?php selected($current_weight, 'medium'); ?>>Medium</option>
                                    <option value="bold" <?php selected($current_weight, 'bold'); ?>>Bold</option>
                                </select>
                            </div>

                            <div>
                                <label style="display:block; font-weight:600; margin-bottom:5px;" for="mai_image_line_height">Line Height</label>
                                <input type="number" name="mai_image_line_height" id="mai_image_line_height"
                                    value="<?php echo esc_attr(get_option('mai_image_line_height')); ?>" placeholder="<?= INIKAH_MAI__LINE_HEIGHT ?>"
                                    style="width: 70px;" step="0.1" min="0.5" max="3.0">
                            </div>

                            <div>
                                <label style="display:block; font-weight:600; margin-bottom:5px;" for="mai_image_text_color">Text Color</label>
                                <input type="color" name="mai_image_text_color" id="mai_image_text_color"
                                    value="<?php echo esc_attr(get_option('mai_image_text_color', INIKAH_MAI__TEXT_COLOR)); ?>"
                                    style="width: 70px; min-height: 40px; cursor: pointer;">
                            </div>

                        </div>
                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        <label for="mai_image_featured_post_types">
                            Apply Placeholder Featured Image
                        </label>
                    </th>
                    <td>
                        <?php
                        $selected = (array) get_option('mai_image_featured_post_types', []);

                        foreach (get_post_types(['show_ui' => true], 'objects') as $post_type) :

                            if (in_array($post_type->name, [
                                'attachment',
                                'revision',
                                'nav_menu_item',
                                'custom_css',
                                'customize_changeset',
                                'oembed_cache',
                                'user_request',
                                'wp_block',
                                'wp_navigation',
                                'wp_template',
                                'wp_template_part',
                                'wp_global_styles',
                                'wp_font_family',
                                'wp_font_face',
                                'shop_coupon',
                                'shop_order',
                            ], true)) {
                                continue;
                            }
                        ?>
                            <label style="display:block;margin-bottom:6px;">
                                <input
                                    type="checkbox"
                                    name="mai_image_featured_post_types[]"
                                    value="<?php echo esc_attr($post_type->name); ?>"
                                    <?php checked(in_array($post_type->name, $selected, true)); ?>>

                                <?php echo esc_html($post_type->labels->singular_name); ?>
                                <code><?php echo esc_html($post_type->name); ?></code>
                            </label>
                        <?php endforeach; ?>

                        <p class="description">
                            Select the post types where placeholder featured images will be generated automatically.
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button('Save Settings'); ?>
    </form>

</div>