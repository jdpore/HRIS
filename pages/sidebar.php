<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="dashboard.php">HRIS</a>
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
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#leave"
                aria-expanded="false" aria-controls="leave">
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
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#ob"
                aria-expanded="false" aria-controls="ob">
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