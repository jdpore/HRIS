<?php
include 'db_conn.php';
include 'autoRedirect.php';

$commonQuery = "";

$overTimePendingListQuery = "SELECT * FROM applied_over_time WHERE status = 'Pending'";
$overTimeApprovedListQuery = "SELECT * FROM applied_over_time WHERE status = 'Approved'";
$overTimeDisapprovedListQuery = "SELECT * FROM applied_over_time WHERE status = 'Disapproved'";

// Construct SQL queries based on user role
switch ($user_user_role) {
    case "Director":
        $underDepartmentsArray = json_decode($user_underDepartments, true);
        // Construct department list string
        $departmentList = "'" . implode("','", $underDepartmentsArray) . "'";
        $commonQuery = "";
        break;
    case "VP":
        $underDepartmentsArray = json_decode($user_underDepartments, true);
        // Construct department list string
        $departmentList = "'" . implode("','", $underDepartmentsArray) . "'";
        $commonQuery = " AND department IN ($departmentList)";
        break;
    case "SAVP":
        $underDepartmentsArray = json_decode($user_underDepartments, true);
        // Construct department list string
        $departmentList = "'" . implode("','", $underDepartmentsArray) . "'";
        $commonQuery = " AND department IN ($departmentList)";
        break;
    case "AVP":
        $underDepartmentsArray = json_decode($user_underDepartments, true);
        // Construct department list string
        $departmentList = "'" . implode("','", $underDepartmentsArray) . "'";
        $commonQuery = " AND department IN ($departmentList)";
        break;
    case "Senior Manager":
        $commonQuery = " AND department = '$user_department'";
        break;
    case "Manager":
        $commonQuery = " AND department = '$user_department'";
        break;
    case "Assistant Manager":
        $commonQuery = " AND department = '$user_department'";
        break;
    case "User":
        $commonQuery = " AND employee_number = '$user_employee_number'";
        break;
    default:
        $commonQuery = "";
        break;
}

// Append common part to each query
$overTimePendingListQuery .= $commonQuery;
$overTimeApprovedListQuery .= $commonQuery;
$overTimeDisapprovedListQuery .= $commonQuery;

// Execute queries
$overTimePendingList = mysqli_query($conn, $overTimePendingListQuery);
$countPendingOverTime = mysqli_num_rows($overTimePendingList);

$overTimeApprovedList = mysqli_query($conn, $overTimeApprovedListQuery);
$countApprovedOverTime = mysqli_num_rows($overTimeApprovedList);

$overTimeDisapprovedList = mysqli_query($conn, $overTimeDisapprovedListQuery);
$countDisapprovedOverTime = mysqli_num_rows($overTimeDisapprovedList);

?>