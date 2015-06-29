<?php

require_once('common_include.php');

$result = mysqli_query($link, 'SELECT timestamp FROM images ORDER BY id DESC LIMIT 1');
$data = array();
if ($result) {
    $row = mysqli_fetch_assoc($result);

    date_default_timezone_set('UTC');
    $time = date("c", strtotime($row['timestamp']));
    $is_outdated = strtotime($row['timestamp']) < strtotime('-15 minutes');

    $arr = array(
        'time' => $time,
        'is_outdated' => $is_outdated
    );

    $json_string = json_encode($arr);

    if (array_key_exists('callback', $_GET)) {
        header('Content-Type: text/javascript; charset=utf8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Max-Age: 3628800');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

        $callback = $_GET['callback'];
        echo $callback . '(' . $json_string . ');';
    } else {
        header('Content-Type: application/json');
        echo $json_string;
    }
} else {
    die('Error: Invalid query: ' . mysqli_error());
}

