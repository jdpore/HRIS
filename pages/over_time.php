<?php
include '../php/autoRedirect.php';
include '../php/overTimeList.php';
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
                    <div class="col-10">
                        <?php
                        $pageTitle = '';
                        if (isset ($_GET['stat'])) {
                            $stat = $_GET['stat'];
                            $pageTitle = "Over Time - $stat";
                            if ($_GET['stat'] == 'Pending') {
                                $list = $overTimePendingList;
                            } elseif ($_GET['stat'] == 'Approved') {
                                $list = $overTimeApprovedList;
                            } elseif ($_GET['stat'] == 'Disapproved') {
                                $list = $overTimeDisapprovedList;
                            }
                        }
                        echo '<h1>' . $pageTitle . '</h1>';
                        ?>
                    </div>
                    <div class="col-2">
                        <div class="input-group rounded">
                            <input type="search" id="searchInput" class="form-control rounded" placeholder="Search"
                                aria-label="Search" aria-describedby="search-addon" />
                            <span class="input-group-text border-0 bg-white" id="search-addon">
                                <i class="lni lni-search-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row h-75 overflow-auto">
                    <div class="col-12">
                        <table id="table" class="table table-borderless table-striped">
                            <thead class="sticky">
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Employee Number</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Over Time Type</th>
                                    <th scope="col">Date Applied</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $item) {
                                    $id = $item['id'];
                                    echo '<tr>';
                                    echo '<th scope="row">
                                            <a href="../php/overTimeData.php?status=' . $_GET['stat'] . '&id=' . $id . '">
                                                <button type="button" class="btn btn-success btn-sm">
                                                    <i class="lni lni-eye"></i>
                                                </button>
                                            </a>
                                        </th>';
                                    echo "<td>" . $item['employee_number'] . "</td>";
                                    echo "<td>" . $item['last_name'] . "</td>";
                                    echo "<td>" . $item['first_name'] . "</td>";
                                    echo "<td>" . $item['over_time_type'] . "</td>";
                                    echo "<td>" . $item['date_applied'] . "</td>";
                                    echo '</tr>';
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/search.js"></script>
    <script>
        var userRole = "<?php echo $user_user_role; ?>";

        // JavaScript to show/hide based on the user role
        if (userRole === "Admin") {
            document.getElementById("employeeLink").classList.remove("d-none");
        }
    </script>
</body>

</html>