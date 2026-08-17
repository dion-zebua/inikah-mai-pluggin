<?php
if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

global $wpdb;

$like = $wpdb->esc_like('mai_') . '%';

$wpdb->query(
    $wpdb->prepare(
        "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s",
        $like
    )
);
