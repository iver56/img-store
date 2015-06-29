<?php
require_once ('common_include.php');

if (isset($_GET["pw"]) && $_GET["pw"] == SCHEDULER_PASSWORD) {
    $result = mysqli_query($link, 'SELECT content, timestamp FROM images ORDER BY id DESC LIMIT 1');
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        $is_outdated = strtotime($row['timestamp']) < strtotime('-150 minutes');
        if ($is_outdated) {
            die('There is no new file to transfer');
        }

        $base64 = $row['content'];
        $stream = fopen('data://image/jpeg;base64,' . $base64, 'r');

        $conn_id = ftp_connect(FTP_SERVER);
        $login_result = ftp_login($conn_id, FTP_USER_NAME, FTP_USER_PASS);

        // upload the file
        if (ftp_fput($conn_id, FTP_REMOTE_FILE_PATH, $stream, FTP_BINARY)) {
            echo "File successfully uploaded";
        } else {
            http_response_code(500);
            echo "There was a problem while uploading the file. \n";
            echo var_dump(error_get_last());
        }
        ftp_close($conn_id);
    }
} else {
    http_response_code(400);
    die('Invalid request');
}
