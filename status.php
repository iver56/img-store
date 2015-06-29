<?php
require_once ('common_include.php');

$result = mysqli_query($link, 'SELECT timestamp FROM images ORDER BY id DESC LIMIT 1');
$data = array();
if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    $is_outdated = strtotime($row['timestamp']) < strtotime('-15 minutes');
    
    $arr = array(
        'timestamp' => $row['timestamp'],
        'is_outdated' => $is_outdated
    );
        
    header('Content-Type: application/json');
    echo json_encode($arr);
} else {
    die('Error: Invalid query: ' . mysqli_error());
}
