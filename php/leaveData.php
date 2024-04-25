<?php
include 'db_conn.php';

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $id = $_GET['id'];

    $sql = "SELECT * FROM applied_leave WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    foreach ($result as $data) {
        $leaveID = $id;
        $employee_number = $data['employee_number'];
        $last_name = $data['last_name'];
        $first_name = $data['first_name'];
        $department = $data['department'];
        $designation = $data['designation'];
        $email = $data['email'];
        $leave_type = $data['leave_type'];
        $date_time_from = $data['date_time_from'];
        $date_time_to = $data['date_time_to'];
        $description = $data['description'];
        $date_applied = $data['date_applied'];
        $status = $data['status'];
        $update_date = $data['update_date'];
    }
    session_start();
    $_SESSION['leaveID'] = $leaveID;
    $_SESSION['employee_number'] = $employee_number;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['department'] = $department;
    $_SESSION['designation'] = $designation;
    $_SESSION['email'] = $email;
    $_SESSION['leave_type'] = $leave_type;
    $_SESSION['date_time_from'] = $date_time_from;
    $_SESSION['date_time_to'] = $date_time_to;
    $_SESSION['description'] = $description;
    $_SESSION['date_applied'] = $date_applied;
    $_SESSION['status'] = $status;
    $_SESSION['update_date'] = $update_date;

    header("Location: ../pages/view-leave.php");
    exit();
}
?>