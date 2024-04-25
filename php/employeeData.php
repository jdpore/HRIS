<?php
include 'db_conn.php';

$sql = "SELECT * from user";
$employeeData = mysqli_query($conn, $sql);

if (isset($_POST['employee_number'])) {
    // Sanitize the input to prevent SQL injection
    $employeeNumber = $_POST['employee_number'];

    // Prepare and execute SQL query to fetch employee data based on employee number
    $sql = "SELECT * FROM user WHERE employee_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employeeNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch the data from the result set
        $row = $result->fetch_assoc();

        // Return the fetched data as JSON response
        echo json_encode($row);
    } else {
        // No employee found with the provided employee number
        echo json_encode(['error' => 'Employee not found']);
    }
}

?>