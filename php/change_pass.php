<?php
include 'db_conn.php';

if (isset ($_GET['user'])) {
    $userName = $_GET['user'];
}

if (isset ($_POST['updatePasswordButton'])) {
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $currentDateTime = date("Y-m-d H:i:s");

    $update_password = "UPDATE user SET status = 'Online', activity = '$currentDateTime', password = '$password' WHERE email = '$userName'";
    $update_password_result = mysqli_query($conn, $update_password);
    if ($update_password_result) {
        $name = "hris_user";
        $value = $userName;
        $expiry = time() + (86400); // Cookie will expire in 30 days
        $path = "/"; // Cookie will be available for the entire domain
        $domain = ""; // If you want to restrict the cookie to a specific subdomain, specify it here
        $secure = false; // If true, the cookie will only be sent over secure connections (HTTPS)
        $httpOnly = false; // If true, the cookie will be accessible only through the HTTP protocol (not accessible via JavaScript)
        setcookie($name, $value, $expiry, $path, $domain, $secure, $httpOnly);
        header("Location: /hris/pages/dashboard.php");
    } else {
        echo '<script>
                window.location.href = "/hris/index.php";
                alert("Login failed.")
            </script>';
    }
}
?>