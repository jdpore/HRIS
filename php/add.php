<?php
include 'db_conn.php';
include 'formFields.php';

if (isset($_POST['addEmployeeButton'])) {
    $userData = array();
    foreach ($addUser1 as $field) {
        if (isset($_POST[$field])) {
            if ($field == 'employee_number') {
                // Ensure that the employee number is treated as a string
                $userData[$field] = strval($_POST[$field]);
            } else {
                $userData[$field] = $_POST[$field];
            }
        } else {
            // Handle missing data if necessary
            $userData[$field] = ''; // Set default value or handle error
        }
    }

    // Check if employee_number already exists
    $existingEmployeeNumber = $userData['employee_number'];
    $checkDuplicateQuery = "SELECT COUNT(*) as count FROM user WHERE employee_number = ?";
    $checkStmt = $conn->prepare($checkDuplicateQuery);
    $checkStmt->bind_param('s', $existingEmployeeNumber);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $row = $result->fetch_assoc();
    $duplicateCount = $row['count'];

    if ($duplicateCount > 0) {
        $message = "Employee with this employee number already exists.";
        echo "<script>
                        alert('" . $message . "');
                        window.location.href = '../pages/employee.php';
                    </script>";
        exit(); // Exit the script if duplicate found
    } else {
        // Define the table name
        $tableName = 'user';

        // Construct the SQL query
        $sql = "INSERT INTO $tableName (";
        $sql .= implode(',', $addUser); // Insert column names
        $sql .= ") VALUES (";
        $sql .= rtrim(str_repeat('?,', count($addUser)), ','); // Insert placeholders for values
        $sql .= ")";

        $stmt = $conn->prepare($sql);

        // Get the values from $userData array
        $values = array_values($userData);

        // Bind parameters
        $stmt->bind_param(str_repeat('s', count($values)), ...$values);

        // Execute the statement
        $stmt->execute();
        if ($stmt) {
            include 'autoRedirect.php';
            $transaction = "Added Employee: $existingEmployeeNumber";

            $history_update = "INSERT INTO history (
                transaction, person_incharge
            ) VALUES(
                '$transaction', '$user_employee_number'
            )";
            $history_update_result = mysqli_query($conn, $history_update);

            $message = "Employee Added.";
            echo "<script>
                        window.location.href = '../pages/employee.php';
                        alert('" . $message . "')
                    </script>";
        }
    }
}

?>