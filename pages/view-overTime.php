<?php
include '../php/autoRedirect.php';
session_start();

// Retrieve session variables
$OTID = $_SESSION['OTID'];
$employee_number = $_SESSION['employee_number'];
$last_name = $_SESSION['last_name'];
$first_name = $_SESSION['first_name'];
$department = $_SESSION['department'];
$designation = $_SESSION['designation'];
$email = $_SESSION['email'];
$over_time_type = $_SESSION['over_time_type'];
$over_time_date = $_SESSION['over_time_date'];
$start_time = $_SESSION['start_time'];
$end_time = $_SESSION['end_time'];
$description = $_SESSION['description'];
$date_applied = $_SESSION['date_applied'];
$status = $_SESSION['status'];
$update_date = $_SESSION['update_date'];
$name = $first_name . ' ' . $last_name;
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
        <?php include 'sidebar.php' ?>
        <div class="main p-5" style="height: 100vh">
            <div class="container-fluid shadow-lg bg-body rounded p-5 h-100">
                <div class="border-bottom row align-items-center mb-5 py-3">
                    <div class="col-6">
                        <h1>Over Time -
                            <?php echo $status ?>
                        </h1>
                    </div>
                    <div class="col-6 text-end">
                        <!-- Button to trigger modal -->
                        <div class="dropdown">
                            <a href="over_time.php?stat=<?php echo $status ?>">
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
                                        <a href="../php/response.php?over_time_id_approve=<?php echo $OTID ?>"
                                            class="btn btn-outline-success btn-lg">Approve</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid gap-2">
                                        <a href="../php/response.php?=<?php echo $OTID ?>"
                                            class="btn btn-outline-danger btn-lg">Disapprove</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-8 pt-3 ps-5">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <p class="fs-5 fw-bold text">Over Time Type</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fs-5 text">
                                    <?php echo $over_time_type ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <p class="fs-5 fw-bold text">Over Time Date</p>
                            </div>
                            <div class="col-md-1">
                                <p class="fs-5 fw-bold text">:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="fs-5 text">
                                    <?php echo $over_time_date ?>
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
                            <p class="fs-5 fw-bold text mb-4">Purpose of OT :</p>
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
        var userRole = "<?php echo $user_user_role; ?>";

        // JavaScript to show/hide based on the user role
        if (userRole === "Admin") {
            document.getElementById("employeeLink").classList.remove("d-none");
        }
    </script>
</body>

</html>