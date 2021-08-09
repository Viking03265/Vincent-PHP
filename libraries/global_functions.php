<?php

include ('config.php');

function base_url() {
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}

function asset_url($asset = '') {
    return base_url() . 'assets/' . $asset;
}

function db_connect() {
    return new mysqli($db_config->hostname, $db_config->username, $db_config->password, $db_config->database);
}

?>