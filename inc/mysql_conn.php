<?php

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASWORD, DB_NAME) or die('Could not connect to MySQL.');
@mysqli_query($dbc, 'SET NAMES UTF8;');

function escape_data($data) {
    if (ini_get('magic_quotes_gpc')) {
        $data = stripslashes($data);
    }
    global $dbc;
    $data = mysqli_real_escape_string($dbc, trim($data));
    return $data;
}

?>
