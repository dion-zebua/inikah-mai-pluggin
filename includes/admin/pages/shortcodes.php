<?php
if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

use Inikah_Mai\FrontEnd\Shortcodes;

$shortcodes = Shortcodes::get_shortcodes();

?>



<div class="wrap">
    <h1>Shortcodes - <?= get_plugin_data(INIKAH_MAI__FILE)['Name'] ?></h1>
    <p>Use the following shortcodes on your WordPress pages, posts, or widgets!</p>

    <hr class="wp-header-end">

    <table class="widefat fixed striped">
        <thead>
            <tr>
                <th width="30%">Shortcode</th>
                <th>Description</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($shortcodes as $shortcode => $description) : ?>

                <tr>
                    <td>
                        <code>[<?= esc_html($shortcode) ?>]</code>
                    </td>

                    <td>
                        <?= esc_html($description) ?>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

</div>