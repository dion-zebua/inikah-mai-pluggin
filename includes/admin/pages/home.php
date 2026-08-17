<?php
if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

?>



<div class="wrap">
    <div class="wrap">
        <h1>Home - <?= get_plugin_data(INIKAH_MAI__FILE)['Name'] ?></h1>
        <p>Hy 🖐️. Welcome to my first WordPress plugin, built with passion and dedication.</p>
        <br>
        <p>Pluggin Name : <?= get_plugin_data(INIKAH_MAI__FILE)['Name'] ?></p>
        <p>Pluggin Version : <?= get_plugin_data(INIKAH_MAI__FILE)['Version'] ?></p>
        <p>Pluggin Description : <?= get_plugin_data(INIKAH_MAI__FILE)['Description'] ?></p>
        <p>Pluggin Author : <a href="<?= get_plugin_data(INIKAH_MAI__FILE)['AuthorURI'] ?>"><?= get_plugin_data(INIKAH_MAI__FILE)['Author'] ?></a></p>
    </div>

    <div class="wrap">

        <hr class="wp-header-end">

        <h2>Featured Image Notes</h2>
        <div class="wrap">

            <div class="notice notice-warning inline">
                <p><strong>Generated Image URL</strong></p>

                <ul style="list-style: disc; margin-left: 20px;">
                    <li>Generated images are virtual and are not stored in the Media Library.</li>
                    <li>Avoid using special characters in post titles whenever possible, as they may affect the generated image URL.</li>
                </ul>
            </div>

            <div class="notice notice-warning inline">
                <p><strong>Featured Image Block</strong></p>

                <ul style="list-style: disc; margin-left: 20px;">
                    <li>The featured image is generated only when a Featured Image block is added to the post or page.</li>
                    <li>It is applied only to the selected post types.</li>
                </ul>
            </div>

            <div class="notice notice-warning inline">
                <p><strong>Featured Image Placeholder</strong></p>

                <ul style="list-style: disc; margin-left: 20px;">
                    <li>Placeholder images are generated only for posts without a featured image.</li>
                    <li>It is applied only to the selected post types.</li>
                </ul>
            </div>

            <div class="notice notice-warning inline">
                <p><strong>Open Graph (OG) Image</strong></p>

                <ul style="list-style: disc; margin-left: 20px;">
                    <li>OG images are not generated for the homepage, archive pages, search pages, or posts that already have a featured image.</li>
                    <li>It is applied only to the selected post types.</li>
                    <li>For the best compatibility, it is recommended to use the Yoast SEO plugin.</li>
                </ul>
            </div>

            <div class="notice notice-warning inline">
                <p><strong>Schema Markup Image</strong></p>

                <ul style="list-style: disc; margin-left: 20px;">
                    <li>It is applied only to the selected post types.</li>
                    <li>For the best compatibility, it is recommended to use the Yoast SEO plugin.</li>
                </ul>
            </div>
        </div>
    </div>


</div>