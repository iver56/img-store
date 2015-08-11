<?php
require_once('common_include.php');

$result = mysqli_query($link, 'SELECT content FROM images ORDER BY id DESC LIMIT 1');
$data = array();
if ($result) {
    header('Content-Type: image/jpeg');

    if ($result->num_rows == 0) {
        http_response_code(404);
        $not_available_img = imagecreate(1024, 768);
        $background = imagecolorallocate($not_available_img, 0, 0, 0);
        $text_color = imagecolorallocate($not_available_img, 155, 155, 155);
        imagestring($not_available_img, 5, 414, 379, "Image is not available", $text_color);
        imagejpeg($not_available_img);
        imagecolordeallocate($background);
        imagecolordeallocate($text_color);
        imagedestroy($text_color);
    }
    $row = mysqli_fetch_assoc($result);
    $base64 = $row['content'];
    $image_file = base64_decode($base64);
    echo $image_file;
} else {
    die('Error: Invalid query: ' . mysqli_error());
}
