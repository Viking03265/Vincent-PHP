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

function db_save_choices($mysqli, $choices) {

    $query = "INSERT INTO table_name (column1, column2, column3, column4) 
            VALUES (value1, value2, value3, ...)";

    $query = str_replace('table_name', 'choices', $query);
    $query = str_replace('column1', 'option1', $query);
    $query = str_replace('column2', 'option2', $query);
    $query = str_replace('column3', 'option3', $query);
    $query = str_replace('column4', 'choice', $query);

    $query = str_replace('value1', $choices->option1, $query);
    $query = str_replace('value2', $choices->option2, $query);
    $query = str_replace('value3', $choices->option3, $query);
    $query = str_replace('value4', $choices->choice, $query);

    return $mysqli->query($query);
}

function db_close($mysqli) {
    return $mysqli->close();
}

?>