<?php
include '../php/autoRedirect.php';
session_start();

// Retrieve session variables
$leaveID = $_SESSION['leaveID'];
$employee_number = $_SESSION['employee_number'];
$last_name = $_SESSION['last_name'];
$first_name = $_SESSION['first_name'];
$department = $_SESSION['department'];
$designation = $_SESSION['designation'];
$email = $_SESSION['email'];
$leave_type = $_SESSION['leave_type'];
$date_time_from = $_SESSION['date_time_from'];
$date_time_to = $_SESSION['date_time_to'];
$description = $_SESSION['description'];
$date_applied = $_SESSION['date_applied'];
$status = $_SESSION['status'];
$update_date = $_SESSION['update_date'];
$name = $first_name . ' ' . $last_name;

// Convert strings to DateTime objects
$start_date = new DateTime($date_time_from);
$end_date = new DateTime($date_time_to);

// If the dates are the same, check the time range
if ($start_date->format('Y-m-d') === $end_date->format('Y-m-d')) {
    // Set the time ranges for work hours and lunch break
    $work_start = new DateTime($start_date->format('Y-m-d') . ' 08:00:00');
    $work_end = new DateTime($start_date->format('Y-m-d') . ' 18:00:00');
    $lunch_start = new DateTime($start_date->format('Y-m-d') . ' 12:00:00');
    $lunch_end = new DateTime($start_date->format('Y-m-d') . ' 13:00:00');

    // Check if the time falls within work hours
    if ($start_date >= $work_start && $end_date <= $work_end) {
        $days = 1; // Full day
    } elseif ($start_date < $lunch_start && $end_date > $lunch_end) {
        $days = 1; // Full day
    } else {
        $days = 0.5; // Half day
    }
} else {
    // Calculate the difference between dates
    $interval = $start_date->diff($end_date);

    // Get the difference in days
    $days = $interval->days + 1; // Add 1 to include both start and end dates
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/table.css">
    <style>
        @keyframes revealDown {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .main {
            animation: revealDown 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">HRIS</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item mb-5">
                    <a class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>
                            <?php echo $user_first_name ?>
                        </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#leave" aria-expanded="false" aria-controls="leave">
                        <i class="lni lni-license"></i>
                        <span>Leave</span>
                    </a>
                    <ul id="leave" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="leave.php?stat=Pending" class="sidebar-link">Pending</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="leave.php?stat=Approved" class="sidebar-link">Approved</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="leave.php?stat=Disapproved" class="sidebar-link">Disapproved</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#ob" aria-expanded="false" aria-controls="ob">
                        <i class="lni lni-apartment"></i>
                        <span>Official Business</span>
                    </a>
                    <ul id="ob" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="official-business.php?stat=Pending" class="sidebar-link">Pending</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="official-business.php?stat=Approved" class="sidebar-link">Approved</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="official-business.php?stat=Disapproved" class="sidebar-link">Disapproved</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#over_time" aria-expanded="false" aria-controls="over_time">
                        <i class="lni lni-hourglass"></i>
                        <span>Over Time</span>
                    </a>
                    <ul id="over_time" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="over_time.php?stat=Pending" class="sidebar-link">Pending</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="over_time.php?stat=Approved" class="sidebar-link">Approved</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="over_time.php?stat=Disapproved" class="sidebar-link">Disapproved</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item d-none" id="employeeLink">
                    <a href="employee.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Employee</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../php/logout.php?logout=<?php echo $user_email ?>" class="sidebar-link"
                    onclick="return confirm('Logout Account?')">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-5" style="height: 100vh">
            <div class="container-fluid shadow-lg bg-body rounded p-5 h-100">
                <div class="border-bottom row align-items-center mb-5 py-3">
                    <div class="col-6">
                        <h1>Leave -
                            <?php echo $status ?>
                        </h1>
                    </div>
                    <div class="col-6 text-end">
                        <!-- Button to trigger modal -->
                        <div class="dropdown">
                            <a href="leave.php?stat=<?php echo $status ?>">
                                <button type="button" class="btn btn-outline-secondary">
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row h-75 overflow-auto">
                    <div class="col-4 border-end border-2 p-3 h-100 position-relative">
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <p class="fs-5 fw-bold text">Employee Number</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="fs-5 text">
                                    <?php echo $employee_number ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <p class="fs-5 fw-bold text">Name</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="fs-5 text">
                                    <?php echo $name ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <p class="fs-5 fw-bold text">Department</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="fs-5 text">
                                    <?php echo $department ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <p class="fs-5 fw-bold text">Designation</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="fs-5 text">
                                    <?php echo $designation ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <p class="fs-5 fw-bold text">Email</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="fs-5 text"
                                    style="width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <?php echo $email ?>
                                </p>
                            </div>
                        </div>
                        <?php
                        if ($status === "Pending" && $employee_number !== $user_employee_number) {
                            // Display the buttons only if the status is "Pending"
                            ?>
                            <div class="position-absolute bottom-0 start-0 row ps-3">
                                <div class="col-6">
                                    <div class="d-grid gap-2">
                                        <a href="../php/response.php?leave_id_approve=<?php echo $leaveID ?>"
                                            onclick="showLoading()" class="btn btn-outline-success btn-lg">Approve</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid gap-2">
                                        <a href="../php/response.php?leave_id_disapprove=<?php echo $leaveID ?>"
                                            onclick="showLoading()" class="btn btn-outline-danger btn-lg">Disapprove</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <!-- Loading spinner -->
                        <div id="loading" class="position-fixed top-0 start-0 w-100 h-100 bg-white opacity-75 d-none">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 pt-3 ps-5">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <p class="fs-5 fw-bold text">Nature of Leave</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fs-5 text">
                                    <?php echo $leave_type ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <p class="fs-5 fw-bold text">Period of Leave From</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fs-5 text">
                                    <?php echo $date_time_from ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <p class="fs-5 fw-bold text">Period of Leave To</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fs-5 text">
                                    <?php echo $date_time_to ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <p class="fs-5 fw-bold text">Total Number of Days Absent</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fs-5 text">
                                    <?php echo $days ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <p class="fs-5 fw-bold text">Date of Application</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fs-5 text">
                                    <?php echo $date_applied ?>
                                </p>
                            </div>
                        </div>
                        <?php if ($status != "Pending") { ?>
                            <div class="row mb-5">
                                <div class="col-md-3">
                                    <p class="fs-5 fw-bold text">Status Update</p>
                                </div>
                                <div class="col-md-1">
                                    <p class="fs-5 fw-bold text">:</p>
                                </div>
                                <div class="col-md-8">
                                    <p class="fs-5 text">
                                        <?php echo $update_date ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row mb-2">
                            <p class="fs-5 fw-bold text mb-4">Explanation why leave is necessary or desired :</p>
                            <div class="col-md-12 border-bottom px-4">
                                <p class="fs-5 text">
                                    <?php echo $description ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../js/sidebar.js"></script>
    <script>
        function showLoading() {
            // Show the loading spinner
            document.getElementById('loading').classList.remove('d-none');
        }
        var userRole = "<?php echo $user_user_role; ?>";

        // JavaScript to show/hide based on the user role
        if (userRole === "Admin") {
            document.getElementById("employeeLink").classList.remove("d-none");
        }
    </script>
</body>

</html>