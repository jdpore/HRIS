<?php
include 'db_conn.php';

if (isset ($_COOKIE['hris_user'])) {
    $userName = $_COOKIE['hris_user'];

    $login = "SELECT * FROM user where email = '$userName'";
    $result = mysqli_query($conn, $login);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $qResult = mysqli_fetch_assoc($result);
        $user_id = $qResult['id'];
        $user_employee_number = $qResult['employee_number'];
        $user_last_name = $qResult['last_name'];
        $user_first_name = $qResult['first_name'];
        $user_email = $qResult['email'];
        $user_password = $qResult['password'];
        $user_department = $qResult['department'];
        $user_designation = $qResult['designation'];
        $user_branch = $qResult['branch'];
        $user_user_role = $qResult['user_role'];
        $user_activity = $qResult['activity'];
        $user_underDepartments = $qResult['underDepartments'];
        $currentDateTime = date("Y-m-d H:i:s");

        $status_update = "UPDATE user SET status = 'Online', activity = '$currentDateTime' WHERE id = '$user_id'";
        $status_update_result = mysqli_query($conn, $status_update);
        if ($status_update_result) {
            $name = "hris_user";
            $value = $user_email;
            $expiry = time() + (86400); // Cookie will expire in 30 days
            $path = "/"; // Cookie will be available for the entire domain
            setcookie($name, $value, $expiry, $path, $domain, $secure, $httpOnly);
            header("Location: /hris/pages/dashboard.php");
        } else {
            echo '<script>
                window.location.href = "/hris/index.php";
                alert("Login failed.")
            </script>';
        }
    } else {
        echo '<script>
                window.location.href = "/hris/index.php";
                alert("Login failed.")
            </script>';
    }
} else {
    echo '<script>
                window.location.href = "/hris/index.php";
                alert("Username or Password Incorrect.")
            </script>';
}

if (isset ($_POST['loginButton'])) {
    $userName = $_POST['username'];
    $userPassword = $_POST['password'];

    $login = "SELECT * FROM user where email = '$userName' AND password = '$userPassword'";
    $result = mysqli_query($conn, $login);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $qResult = mysqli_fetch_assoc($result);
        $user_id = $qResult['id'];
        $user_employee_number = $qResult['employee_number'];
        $user_last_name = $qResult['last_name'];
        $user_first_name = $qResult['first_name'];
        $user_email = $qResult['email'];
        $user_password = $qResult['password'];
        $user_department = $qResult['department'];
        $user_designation = $qResult['designation'];
        $user_branch = $qResult['branch'];
        $user_user_role = $qResult['user_role'];
        $user_activity = $qResult['activity'];
        $user_status = $qResult['status'];
        $user_underDepartments = $qResult['underDepartments'];
        $currentDateTime = date("Y-m-d H:i:s");

        if ($user_status === "New") {
            header("Location: /hris/pages/change_password.php?user=$user_email&pass=$user_password");
        } else {
            $status_update = "UPDATE user SET status = 'Online', activity = '$currentDateTime' WHERE id = '$user_id'";
            $status_update_result = mysqli_query($conn, $status_update);
            if ($status_update_result) {

                $name = "hris_user";
                $value = $user_email;
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
    } else {
        echo '<script>
                window.location.href = "/hris/index.php";
                alert("Login failed. Invalid username or password!")
            </script>';
    }
}

?>