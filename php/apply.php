<?php
include 'db_conn.php';
include 'autoRedirect.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// Function to send email notifications
function sendEmailNotification($result, $mail, $link, $subject, $body)
{
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'johndexter.pore@ubix.com.ph';
        $mail->Password = 'efsweledowxsbyng';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        //Recipients
        $mail->setFrom('johndexter.pore@ubix.com.ph', 'UBIX - HR Application');

        // Add recipients from the database
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $mail->addAddress($row['email'], $row['first_name'] . ' ' . $row['last_name']);
            }
        } else {
            echo "No email addresses found for sending notifications.";
            return;
        }

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Function to execute SQL statements
function executeSQL($conn, $sql, $params)
{
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement preparation failed!";
        return false;
    }

    mysqli_stmt_bind_param($stmt, ...$params);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        echo "SQL statement execution failed!";
        return false;
    }
}

if (isset($_POST['applyLeaveButton'])) {
    $leaveType = $_POST['leaveType'];
    $datetimeFrom = $_POST['datetimeFrom'];
    $datetimeTo = $_POST['datetimeTo'];
    $description = $_POST['description'];
    $link = ($user_branch == "Head Office") ? "http://192.168.3.212/hris/" : "http://202.57.36.134/hris/";

    $user_roles = array(
        "User" => "Assistant Manager",
        "Assistant Manager" => "Manager",
        "Manager" => "Senior Manager",
        "Senior Manager" => "AVP",
        "AVP" => "SAVP",
        "SAVP" => "VP",
        "VP" => "Admin"
    );

    if (array_key_exists($user_user_role, $user_roles)) {
        $current_role = $user_roles[$user_user_role];
    } else {
        $current_role = "VP";
    }

    do {
        if (array_key_exists($current_role, $user_roles)) {
            $condition = ($current_role == "AVP" || $current_role == "SAVP" || $current_role == "VP") ?
                "WHERE (FIND_IN_SET('$user_department', underDepartments) > 0 OR user_role IN ('AVP', 'SAVP', 'VP')) AND user_role = '$current_role'" :
                ($current_role == "Director" ?
                    "WHERE user_role = '$current_role'" :
                    "WHERE department = '$user_department' AND branch = '$user_branch' AND user_role = '$current_role'");

            $email_route = "SELECT * FROM USER $condition";
            $result = mysqli_query($conn, $email_route);
            if ($result && mysqli_num_rows($result) > 0) {
                break;
            } else {
                $current_role = $user_roles[$current_role];
            }
        } else {
            $current_role = "VP";
        }
    } while ($current_role != "Admin");

    if ($current_role != "Admin") {
        sendEmailNotification($result, $mail, $link, 'Application of Leave', "Good day! This is to inform you that there are pending leave applications awaiting your approval. Kindly review them at your earliest convenience via $link. Thank you for your attention to this matter");

        $sql = "INSERT INTO applied_leave (employee_number, last_name, first_name, department, branch, designation, email, user_role, leave_type, date_time_from, date_time_to, description, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            "sssssssssssss",
            $user_employee_number,
            $user_last_name,
            $user_first_name,
            $user_department,
            $user_branch,
            $user_designation,
            $user_email,
            $user_user_role,
            $leaveType,
            $datetimeFrom,
            $datetimeTo,
            $description,
            "Pending"
        ];

        if (executeSQL($conn, $sql, $params)) {
            include 'autoRedirect.php';
            $transaction = "Applied for leave";

            $history_update = "INSERT INTO history (
                transaction, person_incharge
            ) VALUES(
                '$transaction', '$user_employee_number'
            )";
            $history_update_result = mysqli_query($conn, $history_update);
            if ($history_update_result) {
                echo '<script>
                    window.location.href = "/hris/pages/dashboard.php";
                    alert("Applied a Leave.")
                </script>';
            } else {
                echo '<script>
                    window.location.href = "/hris/pages/dashboard.php";
                    alert("Application Failed.")
                </script>';
            }
        }
    }
}

if (isset($_POST['applyOfficialBusinessButton'])) {
    $datetimeFrom = $_POST['datetimeFrom'];
    $datetimeTo = $_POST['datetimeTo'];
    $contactPerson = $_POST['contactPerson'];
    $contactNumber = $_POST['contactNumber'];
    $description = $_POST['description'];
    $fileName = "";

    $link = ($user_branch == "Head Office") ? "http://192.168.3.212/hris/" : "http://202.57.36.134/hris/";

    $user_roles = array(
        "User" => "Assistant Manager",
        "Assistant Manager" => "Manager",
        "Manager" => "Senior Manager",
        "Senior Manager" => "AVP",
        "AVP" => "SAVP",
        "SAVP" => "VP",
        "VP" => "Director",
        "Director" => "Admin",
    );

    if (array_key_exists($user_user_role, $user_roles)) {
        $current_role = $user_roles[$user_user_role];
    } else {
        $current_role = "VP";
    }

    do {
        if (array_key_exists($current_role, $user_roles)) {
            $condition = ($current_role == "AVP" || $current_role == "SAVP" || $current_role == "VP") ?
                "WHERE (FIND_IN_SET('$user_department', underDepartments) > 0 OR user_role IN ('AVP', 'SAVP', 'VP')) AND user_role = '$current_role'" :
                ($current_role == "Director" ?
                    "WHERE user_role = '$current_role'" :
                    "WHERE department = '$user_department' AND branch = '$user_branch' AND user_role = '$current_role'");

            $email_route = "SELECT * FROM USER $condition";
            $result = mysqli_query($conn, $email_route);

            if ($result && mysqli_num_rows($result) > 0) {
                break;
            } else {
                $current_role = $user_roles[$current_role];
            }
        } else {
            $current_role = "VP";
        }
    } while ($current_role != "Admin");

    if ($current_role != "Admin") {
        sendEmailNotification($result, $mail, $link, 'Application of OB', "Good day! This is to inform you that there are pending OB applications awaiting your approval. Kindly review them at your earliest convenience via $link. Thank you for your attention to this matter");
        if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['file_upload']['name'];
            // Move the uploaded file to the desired location
        }

        if (!empty($fileName)) {
            if (move_uploaded_file($_FILES['file_upload']['tmp_name'], 'C:/xampp/htdocs/hris/pdf_uploads/' . $fileName)) {
                $sql = "INSERT INTO applied_official_business (employee_number, last_name, first_name, department, branch, designation, email, user_role, date_time_from, date_time_to, contact_person, contact_number, description, status, pdf_upload)
            VALUES ('$user_employee_number', '$user_last_name', '$user_first_name', '$user_department', '$user_branch', '$user_designation', '$user_email', '$user_user_role', '$datetimeFrom', '$datetimeTo', '$contactPerson', '$contactNumber', '$description', 'Pending', '$fileName')";
            }
        } else {
            $sql = "INSERT INTO applied_official_business (employee_number, last_name, first_name, department, branch, designation, email, user_role, date_time_from, date_time_to, contact_person, contact_number, description, status)
            VALUES ('$user_employee_number', '$user_last_name', '$user_first_name', '$user_department', '$user_branch', '$user_designation', '$user_email', '$user_user_role', '$datetimeFrom', '$datetimeTo', '$contactPerson', '$contactNumber', '$description', 'Pending')";
        }

        $application = mysqli_query($conn, $sql);
        if ($application) {
            include 'autoRedirect.php';
            $transaction = "Applied for leave";

            $history_update = "INSERT INTO history (
                transaction, person_incharge
            ) VALUES(
                '$transaction', '$user_employee_number'
            )";
            $history_update_result = mysqli_query($conn, $history_update);
            if ($history_update_result) {
                echo '<script>
                window.location.href = "/hris/pages/dashboard.php";
                alert("Applied a Official Business.")
            </script>';
            } else {
                echo '<script>
                    window.location.href = "/hris/pages/dashboard.php";
                    alert("Application Failed.")
                </script>';
            }
        }
    }
}

if (isset($_POST['applyOverTimeButton'])) {
    $overTimeType = $_POST['overTimeType'];
    $overTimeDate = $_POST['overTimeDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $description = $_POST['description'];
    $link = ($user_branch == "Head Office") ? "http://192.168.3.212/hris/" : "http://202.57.36.134/hris/";

    $user_roles = array(
        "User" => "Assistant Manager",
        "Assistant Manager" => "Manager",
        "Manager" => "Senior Manager",
        "Senior Manager" => "AVP",
        "AVP" => "SAVP",
        "SAVP" => "VP",
        "VP" => "Admin"
    );

    if (array_key_exists($user_user_role, $user_roles)) {
        $current_role = $user_roles[$user_user_role];
    } else {
        $current_role = "VP";
    }

    do {
        if (array_key_exists($current_role, $user_roles)) {
            $condition = ($current_role == "AVP" || $current_role == "SAVP" || $current_role == "VP") ?
                "WHERE (FIND_IN_SET('$user_department', underDepartments) > 0 OR user_role IN ('AVP', 'SAVP', 'VP')) AND user_role = '$current_role'" :
                ($current_role == "Director" ?
                    "WHERE user_role = '$current_role'" :
                    "WHERE department = '$user_department' AND branch = '$user_branch' AND user_role = '$current_role'");

            $email_route = "SELECT * FROM USER $condition";
            $result = mysqli_query($conn, $email_route);
            if ($result && mysqli_num_rows($result) > 0) {
                break;
            } else {
                $current_role = $user_roles[$current_role];
            }
        } else {
            $current_role = "VP";
        }
    } while ($current_role != "Admin");

    if ($current_role != "Admin") {
        sendEmailNotification($result, $mail, $link, 'Application of Over Time', "Good day! This is to inform you that there are pending over time applications awaiting your approval. Kindly review them at your earliest convenience via $link. Thank you for your attention to this matter");

        $sql = "INSERT INTO applied_over_time (employee_number, last_name, first_name, department, branch, designation, email, user_role, over_time_type, over_time_date, start_time, end_time, description, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            "ssssssssssssss",
            $user_employee_number,
            $user_last_name,
            $user_first_name,
            $user_department,
            $user_branch,
            $user_designation,
            $user_email,
            $user_user_role,
            $overTimeType,
            $overTimeDate,
            $startTime,
            $endTime,
            $description,
            "Pending"
        ];

        if (executeSQL($conn, $sql, $params)) {
            include 'autoRedirect.php';
            $transaction = "Applied for over time";

            $history_update = "INSERT INTO history (
                transaction, person_incharge
            ) VALUES(
                '$transaction', '$user_employee_number'
            )";
            $history_update_result = mysqli_query($conn, $history_update);
            if ($history_update_result) {
                echo '<script>
                    window.location.href = "/hris/pages/dashboard.php";
                    alert("Applied a Over Time.")
                </script>';
            } else {
                echo '<script>
                    window.location.href = "/hris/pages/dashboard.php";
                    alert("Application Failed.")
                </script>';
            }
        }
    }
}
?>