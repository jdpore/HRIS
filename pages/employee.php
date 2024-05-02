<?php
include '../php/autoRedirect.php';
include '../php/employeeData.php';
include '../php/formFields.php';
include '../php/add.php';
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
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* For Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }

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
                        <h1>Employees</h1>
                    </div>
                    <div class="col-4 text-end">
                        <button type="button" class="btn btn-tool" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                            <i class="lni lni-plus"></i>
                        </button>
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
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add Employee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form class="row g-3" id="addUserForm" name="addUserForm" action=""
                                    onsubmit="return isValid()" method="POST">
                                    <?php foreach ($addUser as $userFields): ?>
                                        <?php if ($userFields !== 'underDepartments'): ?>
                                            <?php $editUserFields = $userFields; ?>
                                            <div class="form-floating col-md-6 mb-2">
                                                <?php if ($userFields == 'user_role'): ?>
                                                    <select class="form-select" name="<?php echo $editUserFields; ?>"
                                                        onchange="toggleCheckbox(<?php echo $editUserFields; ?>)">
                                                        <option disabled selected value="">Select Role...</option>
                                                        <?php foreach ($roles as $roleLists) {
                                                            echo "<option value='$roleLists'>$roleLists</option>";
                                                        } ?>
                                                    </select>
                                                <?php elseif ($userFields == 'branch'): ?>
                                                    <select class="form-select" name="<?php echo $editUserFields; ?>">
                                                        <option disabled selected value="">Select Branch...</option>
                                                        <?php foreach ($branches as $branchList): ?>
                                                            <option value="<?php echo $branchList; ?>">
                                                                <?php echo $branchList; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <?php elseif ($userFields == 'department'): ?>
                                                    <select class="form-select" name="<?php echo $editUserFields; ?>">
                                                        <option disabled selected value="">Select Department...</option>
                                                        <?php foreach ($departments as $departmentList): ?>
                                                            <option value="<?php echo $departmentList; ?>">
                                                                <?php echo $departmentList; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <?php elseif ($userFields == 'email'): ?>
                                                    <input type="email" class="form-control" name="<?php echo $editUserFields; ?>"
                                                        placeholder="Email">
                                                <?php elseif ($userFields == 'password'): ?>
                                                    <input type="password" class="form-control"
                                                        name="<?php echo $editUserFields; ?>" placeholder="Password">
                                                <?php else: ?>
                                                    <input type="text" class="form-control" name="<?php echo $editUserFields; ?>"
                                                        placeholder="<?php echo ucwords(str_replace('_', ' ', $userFields)); ?>">
                                                <?php endif; ?>
                                                <label class="ms-2 form-control-placeholder"
                                                    for="<?php echo $editUserFields; ?>">
                                                    <?php echo ucwords(str_replace('_', ' ', $userFields)); ?>
                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <div class="form-check col-md-12 mb-2" id="addCheckboxContainer"
                                        style="display: none;">
                                        <h5 class="mb-3">Under Departments</h5>
                                        <div class="row">
                                            <?php foreach ($departments as $departmentList): ?>
                                                <div class="col-md-4">
                                                    <div>
                                                        <?php
                                                        // Prepend 'add' to the department name
                                                        $checkboxId = 'add' . str_replace(' ', '', $departmentList);
                                                        ?>
                                                        <input class="form-check-input" type="checkbox"
                                                            value="<?php echo $departmentList; ?>"
                                                            id="<?php echo $checkboxId; ?>Checkbox"
                                                            name="<?php echo $checkboxId; ?>Checkbox"
                                                            onclick="handleCheckboxClickAdd(this)">
                                                        <label class="form-check-label"
                                                            for="<?php echo $checkboxId; ?>Checkbox">
                                                            <?php echo $departmentList; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="underDepartmentClickedInputAdd"
                                        id="underDepartmentClickedInputAdd">
                                    <div class="col-md-12 mt-5">
                                        <button id="addEmployeeButton" name="addEmployeeButton" type="submit"
                                            class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Branch</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($employeeData as $employeeDataRow) {
                                    echo '<tr>';
                                    echo '<th scope="row">
                                            <button type="button" class="btn btn-success btn-sm" onclick="editEmployee(\'' . $employeeDataRow['employee_number'] . '\')" data-bs-toggle="modal"
                                                data-bs-target="#editUserModal">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <a href="../php/delete.php?delete_employee=' . $employeeDataRow['employee_number'] . '" onclick="return confirm(\'Delete Employee?\')" class="btn btn-danger btn-sm">
                                                <i class="lni lni-trash-can"></i>
                                            </a>
                                        </th>';
                                    echo "<td>" . $employeeDataRow['employee_number'] . "</td>";
                                    echo "<td>" . $employeeDataRow['last_name'] . "</td>";
                                    echo "<td>" . $employeeDataRow['first_name'] . "</td>";
                                    echo "<td>" . $employeeDataRow['email'] . "</td>";
                                    echo "<td>" . $employeeDataRow['password'] . "</td>";
                                    echo "<td>" . $employeeDataRow['department'] . "</td>";
                                    echo "<td>" . $employeeDataRow['designation'] . "</td>";
                                    echo "<td>" . $employeeDataRow['branch'] . "</td>";
                                    echo "<td>" . $employeeDataRow['user_role'] . "</td>";
                                    echo "<td>" . $employeeDataRow['status'] . "</td>";
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form class="row g-3" id="editUserForm" name="editUserForm" action="" onsubmit="return isValid()"
                        method="POST">
                        <?php foreach ($addUser as $userFields): ?>
                            <?php if ($userFields !== 'underDepartments'): ?>
                                <?php $editUserFields = 'edit_' . $userFields; ?>
                                <div class="form-floating col-md-6 mb-2">
                                    <?php if ($userFields == 'user_role'): ?>
                                        <select class="form-select" id="<?php echo $editUserFields; ?>"
                                            name="<?php echo $editUserFields; ?>">
                                            <option disabled selected value="">Select Role...</option>
                                            <?php foreach ($roles as $roleLists) {
                                                echo "<option value='$roleLists'>$roleLists</option>";
                                            } ?>
                                        </select>
                                    <?php elseif ($userFields == 'branch'): ?>
                                        <select class="form-select" id="<?php echo $editUserFields; ?>"
                                            name="<?php echo $editUserFields; ?>">
                                            <option disabled selected value="">Select Branch...</option>
                                            <?php foreach ($branches as $branchList): ?>
                                                <option value="<?php echo $branchList; ?>">
                                                    <?php echo $branchList; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php elseif ($userFields == 'department'): ?>
                                        <select class="form-select" id="<?php echo $editUserFields; ?>"
                                            name="<?php echo $editUserFields; ?>">
                                            <option disabled selected value="">Select Department...</option>
                                            <?php foreach ($departments as $departmentList): ?>
                                                <option value="<?php echo $departmentList; ?>">
                                                    <?php echo $departmentList; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php elseif ($userFields == 'email'): ?>
                                        <input type="email" class="form-control" id="<?php echo $editUserFields; ?>"
                                            name="<?php echo $editUserFields; ?>" placeholder="Email">
                                    <?php elseif ($userFields == 'password'): ?>
                                        <input type="password" class="form-control" id="<?php echo $editUserFields; ?>"
                                            name="<?php echo $editUserFields; ?>" placeholder="Password">
                                    <?php else: ?>
                                        <input type="text" class="form-control" id="<?php echo $editUserFields; ?>"
                                            name="<?php echo $editUserFields; ?>"
                                            placeholder="<?php echo ucwords(str_replace('_', ' ', $userFields)); ?>">
                                    <?php endif; ?>
                                    <label class="ms-2 form-control-placeholder" for="<?php echo $editUserFields; ?>">
                                        <?php echo ucwords(str_replace('_', ' ', $userFields)); ?>
                                    </label>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="form-check col-md-12 mb-2" id="editCheckboxContainer" style="display: none;">
                            <h5 class="mb-3">Under Departments</h5>
                            <div class="row">
                                <?php foreach ($departments as $departmentList): ?>
                                    <div class="col-md-4">
                                        <div>
                                            <?php
                                            // Prepend 'add' to the department name
                                            $checkboxId = 'edit' . str_replace(' ', '', $departmentList);
                                            ?>
                                            <input class="form-check-input" type="checkbox"
                                                value="<?php echo $departmentList; ?>"
                                                id="<?php echo $checkboxId; ?>Checkbox"
                                                name="<?php echo $checkboxId; ?>Checkbox"
                                                onclick="handleCheckboxClickEdit(this)">
                                            <label class="form-check-label" for="<?php echo $checkboxId; ?>Checkbox">
                                                <?php echo $departmentList; ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <input type="hidden" name="underDepartmentClickedInputEdit"
                            id="underDepartmentClickedInputEdit">
                        <div class="col-md-12 mt-5">
                            <button id="editEmployeeButton" name="editEmployeeButton" type="submit"
                                class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/search.js"></script>
    <script>
        var userRole = "<?php echo $user_user_role; ?>";

        // JavaScript to show/hide based on the user role
        if (userRole === "Admin") {
            document.getElementById("employeeLink").classList.remove("d-none");
        }
        function toggleCheckbox(selectElement) {
            var checkboxContainer = document.getElementById("addCheckboxContainer");
            if (selectElement.value === "VP" || selectElement.value === "SAVP" || selectElement.value === "AVP") {
                checkboxContainer.style.display = "block";
            } else {
                checkboxContainer.style.display = "none";
            }
        }

        var clickedCheckboxesAdd = [];

        // Function to handle checkbox click event
        function handleCheckboxClickAdd(checkbox) {
            var value = checkbox.value;
            // Check if the checkbox is checked
            if (checkbox.checked) {
                // Add the value to the array if it's not already present
                if (!clickedCheckboxesAdd.includes(value)) {
                    clickedCheckboxesAdd.push(value);
                }
            } else {
                // Remove the value from the array if it's present
                var index = clickedCheckboxesAdd.indexOf(value);
                if (index !== -1) {
                    clickedCheckboxesAdd.splice(index, 1);
                }
            }

            document.getElementById('underDepartmentClickedInputAdd').value = JSON.stringify(clickedCheckboxesAdd);
            console.log(clickedCheckboxesAdd);
        }

        // Function to handle click event of edit button
        function editEmployee(employeeNumber) {
            // AJAX request to fetch employee data
            $.ajax({
                url: '../php/employeeData.php', // Endpoint to fetch employee data
                method: 'POST',
                data: { employee_number: employeeNumber },
                success: function (response) {
                    // Parse the JSON response
                    var employeeData = JSON.parse(response);

                    // Populate other fields
                    <?php foreach ($addUser as $field): ?>
                        $('#edit_<?php echo $field; ?>').val(employeeData.<?php echo $field; ?>);
                    <?php endforeach; ?>

                    var checkboxContainer = document.getElementById("editCheckboxContainer");
                    if (employeeData.user_role === "VP" || employeeData.user_role === "SAVP" || employeeData.user_role === "AVP") {
                        // Parse the JSON data for underDepartments
                        var underDepartments = JSON.parse(employeeData.underDepartments);

                        // Check checkboxes based on underDepartments
                        <?php foreach ($departments as $departmentList): ?>
                            var checkbox = $('#edit<?php echo str_replace(' ', '', $departmentList); ?>Checkbox');
                            var checkboxValue = '<?php echo $departmentList; ?>';
                            if (underDepartments.includes('<?php echo $departmentList; ?>')) {
                                checkbox.prop('checked', true);
                                handleCheckboxClickEdit(checkbox[0], true);
                            } else {
                                checkbox.prop('checked', false);
                            }
                        <?php endforeach; ?>

                        // Toggle checkbox container visibility
                        toggleCheckbox($('#edit_user_role'));
                        checkboxContainer.style.display = "block";
                    } else {
                        checkboxContainer.style.display = "none";
                    }

                    // Show the edit modal
                    $('#editUserModal').modal('show');

                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        }

        var clickedCheckboxesEdit = [];

        // Function to handle checkbox click event
        function handleCheckboxClickEdit(checkbox, programmatic) {
            var value = checkbox.value;
            // Check if the checkbox is checked
            if (checkbox.checked) {
                // Add the value to the array if it's not already present
                if (!clickedCheckboxesEdit.includes(value)) {
                    clickedCheckboxesEdit.push(value);
                }
            } else {
                // Remove the value from the array if it's present
                var index = clickedCheckboxesEdit.indexOf(value);
                if (index !== -1) {
                    clickedCheckboxesEdit.splice(index, 1);
                }
            }

            // Update the hidden input field with the updated array
            document.getElementById('underDepartmentClickedInputEdit').value = JSON.stringify(clickedCheckboxesEdit);

            if (!programmatic) {
                console.log(clickedCheckboxesEdit);
            }
        }
    </script>
</body>

</html>