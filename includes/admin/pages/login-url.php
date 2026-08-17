<?php
if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

$login_url  = wp_login_url();
$login_path = trim(wp_parse_url($login_url, PHP_URL_PATH), '/');

echo $login_path;
?>



<div class="wrap">
    <h1>Change URL Login - <?= get_plugin_data(INIKAH_MAI__FILE)['Name'] ?></h1>
    <p>Setting permalink here!</p>

    <p>Inspired by AIOLogin.com</p>

    <hr class="wp-header-end">

    <form method="post" action="options.php">
        <?php
        settings_fields('inikah_mai_login_url_settings_group');
        do_settings_sections('inikah-mai-login-url');
        ?>

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="mai_login_url_permalink">Permalink Structure</label>
                    </th>
                    <td>
                        <code><?= esc_url(home_url('/')); ?></code>
                        <input type="text" name="mai_login_url_permalink" id="mai_login_url_permalink"
                            value="<?php echo esc_attr(get_option('mai_login_url_permalink')); ?>"
                            class="regular-text" placeholder="<?= $login_path ?>">
                        <p class="description">Slug URL for login.
                            <a target="_blank" href="<?= esc_url(home_url('/')) . esc_attr($login_path) ?>"><?= esc_url(home_url('/')); ?>
                                <code><?php echo esc_attr($login_path); ?></code>
                            </a>.
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button('Save Settings'); ?>
    </form>

</div>