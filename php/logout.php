<?php
include 'db_conn.php';

if (isset($_GET['logout'])) {
    $user_email = $_GET['logout'];
    $currentDateTime = date("Y-m-d H:i:s");

    $status_update = "UPDATE user SET status = 'Offline', activity = '$currentDateTime' WHERE email = '$user_email'";
    $status_update_result = mysqli_query($conn, $status_update);

    if ($status_update_result) {
        $cookieName = "hris_user";
        $cookiePath = "/";
        setcookie($cookieName, "", time() - 1, $cookiePath);
        header("Location: /hris/index.php");
    }

}

?>