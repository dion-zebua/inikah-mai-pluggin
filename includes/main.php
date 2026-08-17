<?php

if (!defined('ABSPATH')) {
    header("Location: /404", true, 302);
}

global $inikah_mai;

if (is_null($inikah_mai)) {

    require_once INIKAH_MAI__DIR_PATH . 'includes/class-inikah-mai.php';

    $inikah_mai = INIKAH_MAI\Inikah_Mai::get_instance();
    
}

return $inikah_mai;
