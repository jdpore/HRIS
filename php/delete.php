<?php
include 'db_conn.php';
if (isset($_GET['delete_employee'])) {
    $employee_number = $_GET['delete_employee'];

    $delete_employee = "DELETE FROM user WHERE employee_number = $employee_number;";
    $delete_employee_result = mysqli_query($conn, $delete_employee);
    if ($delete_employee_result) {
        include 'autoRedirect.php';
        $transaction = "Deleted Employee: $employee_number";

        $history_update = "INSERT INTO history (
                transaction, person_incharge
            ) VALUES(
                '$transaction', '$user_employee_number'
            )";
        $history_update_result = mysqli_query($conn, $history_update);
        if ($history_update_result) {
            $message = "Employee Deleted.";
            echo "<script>
                        window.location.href = '/hris/pages/employee.php';
                        alert('" . $message . "')
                    </script>";
        }
    }
}

?>