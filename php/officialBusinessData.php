<?php
include 'db_conn.php';

if (isset ($_GET['status'])) {
    $status = $_GET['status'];
    $id = $_GET['id'];

    $sql = "SELECT * FROM applied_official_business WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    foreach ($result as $data) {
        $OBID = $id;
        $employee_number = $data['employee_number'];
        $last_name = $data['last_name'];
        $first_name = $data['first_name'];
        $department = $data['department'];
        $designation = $data['designation'];
        $email = $data['email'];
        $date_time_from = $data['date_time_from'];
        $date_time_to = $data['date_time_to'];
        $contact_person = $data['contact_person'];
        $contact_number = $data['contact_number'];
        $description = $data['description'];
        $date_applied = $data['date_applied'];
        $status = $data['status'];
        $update_date = $data['update_date'];
        $pdf_upload = $data['pdf_upload'];
    }
    session_start();
    $_SESSION['OBID'] = $OBID;
    $_SESSION['employee_number'] = $employee_number;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['department'] = $department;
    $_SESSION['designation'] = $designation;
    $_SESSION['email'] = $email;
    $_SESSION['date_time_from'] = $date_time_from;
    $_SESSION['date_time_to'] = $date_time_to;
    $_SESSION['contact_person'] = $contact_person;
    $_SESSION['contact_number'] = $contact_number;
    $_SESSION['description'] = $description;
    $_SESSION['date_applied'] = $date_applied;
    $_SESSION['status'] = $status;
    $_SESSION['update_date'] = $update_date;
    $_SESSION['pdf_upload'] = $pdf_upload;

    header("Location: ../pages/view-officialBusiness.php");
    exit();
}
?>