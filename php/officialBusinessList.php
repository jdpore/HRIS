<?php
include 'db_conn.php';
include 'autoRedirect.php';

$commonQuery = "";

$officialBusinessPendingListQuery = "SELECT * FROM applied_official_business WHERE status = 'Pending'";
$officialBusinessApprovedListQuery = "SELECT * FROM applied_official_business WHERE status = 'Approved'";
$officialBusinessDisapprovedListQuery = "SELECT * FROM applied_official_business WHERE status = 'Disapproved'";

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
$officialBusinessPendingListQuery .= $commonQuery;
$officialBusinessApprovedListQuery .= $commonQuery;
$officialBusinessDisapprovedListQuery .= $commonQuery;

// Execute queries
$officialBusinessPendingList = mysqli_query($conn, $officialBusinessPendingListQuery);
$countPendingOB = mysqli_num_rows($officialBusinessPendingList);

$officialBusinessApprovedList = mysqli_query($conn, $officialBusinessApprovedListQuery);
$countApprovedOB = mysqli_num_rows($officialBusinessApprovedList);

$officialBusinessDisapprovedList = mysqli_query($conn, $officialBusinessDisapprovedListQuery);
$countDisapprovedOB = mysqli_num_rows($officialBusinessDisapprovedList);
?>