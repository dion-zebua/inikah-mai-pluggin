<?php

/**
 * Plugin Name: Inikah Mai
 * Description: Plugin to generate WebP image, add featured image from external links, and create multiple shortcodes.
 * Version: 1.0.0
 * Author: Dion Zebua
 * Author URI: https://dionzebua.com/
 */

if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

// C:\laragon\www\folder\wp-content\plugins\inikah-mai\inikah-mai.php
if (!defined('INIKAH_MAI__FILE')) {
    define('INIKAH_MAI__FILE', __FILE__);
}

// C:\laragon\www\folder\wp-content\plugins\inikah-mai/
if (!defined('INIKAH_MAI__DIR_PATH')) {
    define('INIKAH_MAI__DIR_PATH', plugin_dir_path(INIKAH_MAI__FILE));
}

// https://domain.test/wp-content/plugins/inikah-mai/
if (!defined('INIKAH_MAI__DIR_URL')) {
    define('INIKAH_MAI__DIR_URL', plugin_dir_url(INIKAH_MAI__FILE));
}

if (!defined('INIKAH_MAI__VERSION')) {
    define('INIKAH_MAI__VERSION', '1.0.0');
}

if (!defined('INIKAH_MAI_SETTINGS_SLUG')) {
    define('INIKAH_MAI_SETTINGS_SLUG', 'inikah-mai');
}



// Image Default Value
if (!defined('INIKAH_MAI__DEFAULT_BG')) {
    define('INIKAH_MAI__DEFAULT_BG', 'assets/img/default-bg.jpg');
}

if (!defined('INIKAH_MAI__IMAGE_PERMALINK')) {
    define('INIKAH_MAI__IMAGE_PERMALINK', 'generated-image');
}

if (!defined('INIKAH_MAI__FONT_SIZE')) {
    define('INIKAH_MAI__FONT_SIZE', 24);
}

if (!defined('INIKAH_MAI__TEXT_ALIGN')) {
    define('INIKAH_MAI__TEXT_ALIGN', 'center');
}

if (!defined('INIKAH_MAI__FONT_WEIGHT')) {
    define('INIKAH_MAI__FONT_WEIGHT', 'normal');
}

if (!defined('INIKAH_MAI__LINE_HEIGHT')) {
    define('INIKAH_MAI__LINE_HEIGHT', 1.4);
}

if (!defined('INIKAH_MAI__TEXT_COLOR')) {
    define('INIKAH_MAI__TEXT_COLOR', '#ffffff');
}

require_once INIKAH_MAI__DIR_PATH . 'includes/main.php';
