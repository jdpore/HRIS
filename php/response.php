<?php
include 'db_conn.php';
include 'autoRedirect.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset ($_GET['leave_id_approve'])) {
    $tableName = "applied_leave";
    $status = "Approved";
    $statusMessage = "approved";
    $id = $_GET['leave_id_approve'];
    $type = "Leave";
    $emailData = get_application_email($id, $tableName);
    $subject = "Leave Application $status";
    $response = updateApplication($tableName, $status, $id, $emailData, $subject, $statusMessage, $type);
    // Handle or display the response as needed
}

if (isset ($_GET['leave_id_disapprove'])) {
    $tableName = "applied_leave";
    $status = "Disapproved";
    $statusMessage = "disapproved";
    $id = $_GET['leave_id_disapprove'];
    $type = "Leave";
    $emailData = get_application_email($id, $tableName);
    $subject = "Leave Application $status";
    $response = updateApplication($tableName, $status, $id, $emailData, $subject, $statusMessage, $type);
    // Handle or display the response as needed
}

if (isset ($_GET['official_business_id_approve'])) {
    $tableName = "applied_official_business";
    $status = "Approved";
    $statusMessage = "approved";
    $id = $_GET['official_business_id_approve'];
    $type = "Official Business";
    $emailData = get_application_email($id, $tableName);
    $subject = "Official Business Application $status";
    $response = updateApplication($tableName, $status, $id, $emailData, $subject, $statusMessage, $type);
    // Handle or display the response as needed
}

if (isset ($_GET['official_business_id_disapprove'])) {
    $tableName = "applied_official_business";
    $status = "Disapproved";
    $statusMessage = "disapproved";
    $id = $_GET['official_business_id_disapprove'];
    $type = "Official Business";
    $emailData = get_application_email($id, $tableName);
    $subject = "Official Business Application $status";
    $response = updateApplication($tableName, $status, $id, $emailData, $subject, $statusMessage, $type);
    // Handle or display the response as needed
}

if (isset ($_GET['over_time_id_approve'])) {
    $tableName = "applied_over_time";
    $status = "Approved";
    $statusMessage = "approved";
    $id = $_GET['over_time_id_approve'];
    $type = "Over Time";
    $emailData = get_application_email($id, $tableName);
    $subject = "Over Time Application $status";
    $response = updateApplication($tableName, $status, $id, $emailData, $subject, $statusMessage, $type);
    // Handle or display the response as needed
}

if (isset ($_GET['over_time_id_disapprove'])) {
    $tableName = "applied_over_time";
    $status = "Disapproved";
    $statusMessage = "disapproved";
    $id = $_GET['over_time_id_disapprove'];
    $type = "Over Time";
    $emailData = get_application_email($id, $tableName);
    $subject = "Over Time Application $status";
    $response = updateApplication($tableName, $status, $id, $emailData, $subject, $statusMessage, $type);
    // Handle or display the response as needed
}

function get_application_email($id, $tableName)
{
    global $conn; // Assuming $conn is the database connection object

    // Prepare the SQL statement
    $application_search = "SELECT email, first_name FROM $tableName WHERE id = ?";

    // Prepare the statement
    $statement = $conn->prepare($application_search);

    if (!$statement) {
        return "Error preparing statement: " . $conn->error;
    }

    // Bind parameter
    $statement->bind_param("i", $id);

    // Execute the statement
    if (!$statement->execute()) {
        return "Error executing statement: " . $statement->error;
    }

    // Get the result
    $result = $statement->get_result();

    // Fetch the email address and first name from the result
    if ($row = $result->fetch_assoc()) {
        return array(
            'email' => $row['email'],
            'first_name' => $row['first_name']
        );
    } else {
        return "Email not found";
    }
}


function updateApplication($tableName, $status, $id, $emailData, $subject, $statusMessage, $type)
{
    $currentDateTime = new DateTime();
    $formattedDateTime = $currentDateTime->format("Y-m-d H:i:s");

    global $conn; // Assuming $conn is the database connection object

    $current_date_time = date("Y-m-d H:i:s");
    // Prepare the SQL statement with placeholders

    $sql = "UPDATE $tableName SET status = ?, update_date = '$formattedDateTime'  WHERE id = ?";

    // Prepare the statement
    $statement = $conn->prepare($sql);

    // Bind parameters
    $statement->bind_param("si", $status, $id);

    // Execute the statement
    if ($statement->execute()) {
        try {
            $mail = new PHPMailer(true);
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
            $mail->addAddress($emailData['email'], $emailData['first_name']);
            $fname = $emailData['first_name'];
            $body = "
            Dear $fname,

            Your $type application has been $statusMessage. 

            If you have any questions or need further clarification, please feel free to reach out.";
            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);
            $mail->send();
            include 'autoRedirect.php';
            $transaction = "Application no. $id, $subject";
            $history_update = "INSERT INTO history (
                transaction, person_incharge
            ) VALUES(
                '$transaction', '$user_employee_number'
            )";
            $history_update_result = mysqli_query($conn, $history_update);
            header('Location: /hris/pages/dashboard.php');
            return "Email sent successfully";
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        return "Error updating application status: " . $conn->error;
    }
}
?>