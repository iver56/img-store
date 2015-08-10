<?php
require_once('common_include.php');

if (isset($_POST["hub_password"]) && strcmp($_POST["hub_password"], HUB_PASSWORD) === 0) {
    if (isset($_POST["base64"])) {
        $base64 = mysqli_real_escape_string($link, $_POST["base64"]);
        $result = mysqli_query($link, "INSERT INTO images (content) VALUES('$base64')");
        if (!$result) {
            printf("Error: %s\n", mysqli_sqlstate($link));
            exit();
        } else {
            mysqli_query($link, "set @old_id = (SELECT id FROM `images` ORDER BY id DESC LIMIT 1 OFFSET 10)");
            mysqli_query($link, 'DELETE FROM images WHERE id <= @old_id');
            die('ok');
        }
    } else {
        die('missing post data');
    }
} else {
    die('correct hub pw plz');
}
