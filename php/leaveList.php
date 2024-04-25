<?php
include 'db_conn.php';
include 'autoRedirect.php';

$commonQuery = "";

$leavePendingListQuery = "SELECT * FROM applied_leave WHERE status = 'Pending'";
$leaveApprovedListQuery = "SELECT * FROM applied_leave WHERE status = 'Approved'";
$leaveDisapprovedListQuery = "SELECT * FROM applied_leave WHERE status = 'Disapproved'";

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
        $commonQuery = "AND employee_number = '$user_employee_number'";
        break;
    default:
        $commonQuery = "";
        break;
}

// Append common part to each query
$leavePendingListQuery .= $commonQuery;
$leaveApprovedListQuery .= $commonQuery;
$leaveDisapprovedListQuery .= $commonQuery;

// Execute queries
$leavePendingList = mysqli_query($conn, $leavePendingListQuery);
$countPendingLeave = mysqli_num_rows($leavePendingList);

$leaveApprovedList = mysqli_query($conn, $leaveApprovedListQuery);
$countApprovedLeave = mysqli_num_rows($leaveApprovedList);

$leaveDisapprovedList = mysqli_query($conn, $leaveDisapprovedListQuery);
$countDisapprovedLeave = mysqli_num_rows($leaveDisapprovedList);

?>