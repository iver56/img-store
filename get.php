<?php
require_once ('common_include.php');

$result = mysql_query('SELECT id, timestamp, content FROM images ORDER BY id DESC LIMIT 1');
$data = array();
if ($result) {
    while ($row = mysql_fetch_assoc($result)) {
        array_push(
            $data,
            array(
                'id' => $row['id'],
                'timestamp' => $row['timestamp'],
                'content' => $row['content']
            )
        );
    }
    echo json_encode($data);
} else {
    die('Error: Invalid query: ' . mysql_error());
    }
?>