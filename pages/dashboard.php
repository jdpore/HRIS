<?php
include '../php/autoRedirect.php';
include '../php/formFields.php';
include '../php/leaveList.php';
include '../php/officialBusinessList.php';
include '../php/overTimeList.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/sidebar.css">
    <link rel="stylesheet" href="../style/dashboard.css">
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
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-6 text-end">
                        <!-- Button to trigger modal -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Apply
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#applyLeaveModal">Leave</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#applyOfficialBusinessModal">Official
                                        Business</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#applyOverTimeModal">Over
                                        Time</a>
                                </li>
                                <!-- Add more options as needed -->
                            </ul>
                        </div>
                    </div>
                    <div class="modal fade" id="applyLeaveModal" tabindex="-1" aria-labelledby="applyLeaveModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="applyLeaveLabel">Apply Leave</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form class="row g-3" id="applyLeave" name="applyLeave" action="../php/apply.php"
                                        onsubmit="return isValid()" method="POST">
                                        <div id="leave" class="form-floating col-md-12 mb-4">
                                            <h5 class="mb-3">Nature of Leave</h5>
                                            <div class="row">
                                                <?php foreach ($leaveType as $leaveTypeList) {
                                                    // Modify leave type to remove spaces and convert to lowercase
                                                    $modifiedLeaveType = str_replace(' ', '_', strtolower($leaveTypeList));
                                                    echo "
                                                        <div class='col-md-4'>
                                                            <div class='form-check'>
                                                                <input class='form-check-input' type='radio' name='leaveType' id='$modifiedLeaveType'  value='$leaveTypeList'>
                                                                <label class='form-check-label' for='$modifiedLeaveType'>
                                                                    $leaveTypeList
                                                                </label>
                                                            </div>
                                                        </div>";
                                                } ?>
                                            </div>
                                        </div>

                                        <h5 class="mb-0">Period of Leave</h5>
                                        <div class="form-floating col-md-6 mb-2">
                                            <input type="datetime-local" class="form-control" name="datetimeFrom"
                                                id="datetimeFrom" required>
                                            <label class="form-label ms-2" for="datetimeFrom">From</label>
                                        </div>
                                        <div class="form-floating col-md-6 mb-2">
                                            <input type="datetime-local" class="form-control" name="datetimeTo"
                                                id="datetimeTo" required>
                                            <label class="form-label ms-2" for="datetimeTo">To</label>
                                        </div>
                                        <h5 class="mb-0">Details</h5>
                                        <div class="col-md-12 mb-3">
                                            <textarea class="form-control" name="description" id="description"
                                                placeholder="Description" required></textarea>
                                        </div>
                                        <div class="col-md-12 mt-5 text-end">
                                            <button id="applyLeave" name="applyLeaveButton" type="submit"
                                                onclick="showLoading()" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="applyOfficialBusinessModal" tabindex="-1"
                        aria-labelledby="applyOfficialBusinessModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="applyOfficialBusinessModalLabel">Apply Official Business
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form class="row g-3" id="applyOfficialBusiness" name="applyOfficialBusiness"
                                        action="../php/apply.php" enctype="multipart/form-data"
                                        onsubmit="return isValid()" method="POST">
                                        <h5 class="mb-0">Period of Official Business</h5>
                                        <div class="form-floating col-md-6 mb-2">
                                            <input type="datetime-local" class="form-control" name="datetimeFrom"
                                                id="datetimeFrom" required>
                                            <label class="form-label ms-2" for="datetimeFrom">From</label>
                                        </div>
                                        <div class="form-floating col-md-6 mb-2">
                                            <input type="datetime-local" class="form-control" name="datetimeTo"
                                                id="datetimeTo" required>
                                            <label class="form-label ms-2" for="datetimeTo">To</label>
                                        </div>
                                        <h5 class="mb-0">Details</h5>
                                        <div class="form-floating col-md-6 mb-3">
                                            <input type="text" class="form-control" name="contactPerson"
                                                id="contactPerson" placeholder="Contact Person" required>
                                            <label class="form-label ms-2" for="contactPerson">Contact Person</label>
                                        </div>
                                        <div class="form-floating col-md-6 mb-3">
                                            <input type="text" class="form-control" name="contactNumber"
                                                id="contactNumber" placeholder="Contact Person" required>
                                            <label class="form-label ms-2" for="contactNumber">Contact Number</label>
                                        </div>
                                        <div class="col-md-12 mt-1 mb-3">
                                            <textarea class="form-control" name="description" id="description"
                                                placeholder="Description" required></textarea>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-6 mb-3">
                                                <label class="btn btn btn-outline-info me-3">
                                                    <i class="lni lni-paperclip"> <input id="file_upload"
                                                            name="file_upload" type="file" accept=".pdf"
                                                            style="display: none;"></i>
                                                </label>
                                                <span id="file_name" class=""></span>
                                            </div>
                                            <div class="col-md-6 mb-3 text-end">
                                                <button id="applyOfficialBusiness" name="applyOfficialBusinessButton"
                                                    onclick="showLoading()" type="submit"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="applyOverTimeModal" tabindex="-1"
                        aria-labelledby="applyOverTimeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="applyOverTimeLabel">Apply Over Time</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form class="row g-3" id="applyOverTime" name="applyOverTime"
                                        action="../php/apply.php" onsubmit="return isValid()" method="POST">
                                        <div id="overTime" class="form-floating col-md-12 mb-4">
                                            <h5 class="mb-3">Over Time Type</h5>
                                            <div class="row">
                                                <?php foreach ($overTimeType as $overTimeTypeList) {
                                                    // Modify leave type to remove spaces and convert to lowercase
                                                    $modifiedOverTimeType = str_replace(' ', '_', strtolower($overTimeTypeList));
                                                    echo "
                                                        <div class='col-md-4'>
                                                            <div class='form-check'>
                                                                <input class='form-check-input' type='radio' name='overTimeType' id='$modifiedOverTimeType'  value='$overTimeTypeList'>
                                                                <label class='form-check-label' for='$modifiedOverTimeType'>
                                                                    $overTimeTypeList
                                                                </label>
                                                            </div>
                                                        </div>";
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="form-floating col-md-12 mb-2">
                                            <input type="date" class="form-control" name="overTimeDate"
                                                id="overTimeDate" required>
                                            <label class="form-label ms-2" for="overTimeDate">Over Time Date</label>
                                        </div>
                                        <div class="form-floating col-md-6 mb-2">
                                            <input type="time" class="form-control" name="startTime" id="startTime"
                                                required>
                                            <label class="form-label ms-2" for="startTime">Start Time</label>
                                        </div>
                                        <div class="form-floating col-md-6 mb-2">
                                            <input type="time" class="form-control" name="endTime" id="endTime"
                                                required>
                                            <label class="form-label ms-2" for="endTime">End Time</label>
                                        </div>
                                        <h5 class="mb-0">Details</h5>
                                        <div class="col-md-12 mb-3">
                                            <textarea class="form-control" name="description" id="description"
                                                placeholder="Description" required></textarea>
                                        </div>
                                        <div class="col-md-12 mt-5 text-end">
                                            <button id="applyOverTimeButton" name="applyOverTimeButton" type="submit"
                                                onclick="showLoading()" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Loading spinner -->
                    <div id="loading" class="position-fixed top-0 start-0 w-100 h-100 bg-white opacity-75 d-none"
                        style="z-index: 9999;">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row h-75 overflow-auto">
                    <div class="col-4">
                        <div class="col-6">
                            <h1>Leave</h1>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-green text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countApprovedLeave ?>
                                                </h3>
                                                <p>Approved</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            </div>
                                            <a href="leave.php?stat=Approved" class="card-link text-white">View More <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-orange text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countPendingLeave ?>
                                                </h3>
                                                <p>Pending</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-spinner" aria-hidden="true"></i>
                                            </div>
                                            <a href="leave.php?stat=Pending" class="card-link text-white">View More <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-red text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countDisapprovedLeave ?>
                                                </h3>
                                                <p>Disapproved</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-thumbs-down"></i>
                                            </div>
                                            <a href="leave.php?stat=Disapproved" class="card-link text-white">View More
                                                <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="col-6">
                            <h1>Official Business</h1>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-green text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countApprovedOB ?>
                                                </h3>
                                                <p>Approved</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            </div>
                                            <a href="official-business.php?stat=Approved"
                                                class="card-link text-white">View
                                                More <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-orange text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countPendingOB ?>
                                                </h3>
                                                <p>Pending</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-spinner" aria-hidden="true"></i>
                                            </div>
                                            <a href="official-business.php?stat=Pending"
                                                class="card-link text-white">View
                                                More <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-red text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countDisapprovedOB ?>
                                                </h3>
                                                <p>Disapproved</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-thumbs-down"></i>
                                            </div>
                                            <a href="official-business.php?stat=Disapproved"
                                                class="card-link text-white">View More <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="col-6">
                            <h1>Over Time</h1>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-green text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countApprovedOverTime ?>
                                                </h3>
                                                <p>Approved</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            </div>
                                            <a href="over_time.php?stat=Approved" class="card-link text-white">View
                                                More <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-orange text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countPendingOverTime ?>
                                                </h3>
                                                <p>Pending</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-spinner" aria-hidden="true"></i>
                                            </div>
                                            <a href="over_time.php?stat=Pending" class="card-link text-white">View
                                                More <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="card bg-red text-white">
                                        <div class="card-body">
                                            <div class="inner">
                                                <h3>
                                                    <?php echo $countDisapprovedOverTime ?>
                                                </h3>
                                                <p>Disapproved</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-thumbs-down"></i>
                                            </div>
                                            <a href="over_time.php?stat=Disapproved" class="card-link text-white">View
                                                More <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
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

        document.getElementById('file_upload').addEventListener('change', function () {
            var fileName = this.files[0].name;
            document.getElementById('file_name').textContent = fileName;
        });
        var userRole = "<?php echo $user_user_role; ?>";

        // JavaScript to show/hide based on the user role
        if (userRole === "Admin") {
            document.getElementById("employeeLink").classList.remove("d-none");
        }
    </script>
</body>

</html>