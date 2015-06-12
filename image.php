<?php
require_once ('common_include.php');

$result = mysql_query('SELECT content FROM images ORDER BY id DESC LIMIT 1');
$data = array();
if ($result) {
    $row = mysql_fetch_assoc($result);
    $base64 = $row['content'];
    $image_file = base64_decode($base64);
    header('Content-Type: image/jpeg');
    echo $image_file;
} else {
    die('Error: Invalid query: ' . mysql_error());
    }
?>