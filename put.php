<?php
require_once ('common_include.php');


//TODO: check credentials, and store the hub name
if (isset($_POST["base64"])) {
    $base64 = mysql_real_escape_string($_POST["base64"]);
    $result = mysql_query("INSERT INTO images (content) VALUES('$base64')");
    if (!$result) {
        die('Error: Invalid query: ' . mysql_error());
    } else {
        // TODO: if more than 10 images, delete the last one
        echo 'ok';
    }
} else {
    echo 'missing post data';
}
?>