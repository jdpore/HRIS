<?php
include 'db_conn.php';

if (isset ($_GET['status'])) {
    $status = $_GET['status'];
    $id = $_GET['id'];

    $sql = "SELECT * FROM applied_over_time WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    foreach ($result as $data) {
        $OTID = $id;
        $employee_number = $data['employee_number'];
        $last_name = $data['last_name'];
        $first_name = $data['first_name'];
        $department = $data['department'];
        $designation = $data['designation'];
        $email = $data['email'];
        $over_time_type = $data['over_time_type'];
        $over_time_date = $data['over_time_date'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $description = $data['description'];
        $date_applied = $data['date_applied'];
        $status = $data['status'];
        $update_date = $data['update_date'];
    }
    session_start();
    $_SESSION['OTID'] = $OTID;
    $_SESSION['employee_number'] = $employee_number;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['department'] = $department;
    $_SESSION['designation'] = $designation;
    $_SESSION['email'] = $email;
    $_SESSION['over_time_type'] = $over_time_type;
    $_SESSION['over_time_date'] = $over_time_date;
    $_SESSION['start_time'] = $start_time;
    $_SESSION['end_time'] = $end_time;
    $_SESSION['description'] = $description;
    $_SESSION['date_applied'] = $date_applied;
    $_SESSION['status'] = $status;
    $_SESSION['update_date'] = $update_date;

    header("Location: ../pages/view-overTime.php");
    exit();
}
?>