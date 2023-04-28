<?php // function to get the current page name
function PageName()
{
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

$current_page = PageName();
?>

<?php include 'model/fetch_support.php' ?>

<style type="text/css">
    .sidebar.sidebar-style-2 .nav.nav-primary>.nav-item.active>a {
        background: #000000 !important;
        box-shadow: 4px 4px 10px 0 rgb(0 0 0 / 10%), 4px 4px 15px -5px rgb(21 114 232 / 40%) !important;
    }

    .icon-menu:before {
        content: "\e601";
        color: white;
    }

    .icon-options-vertical:before {
        content: "\e602";
        color: white;
    }
</style>

<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if (!empty($_SESSION['avatar'])) : ?>
                        <img src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/' . $_SESSION['avatar'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else : ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>

                </div>
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['username']) && $_SESSION['role'] == 'administrator' ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span>
                            <?= isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : 'Guest User' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest' ?></span>
                            <?= isset($_SESSION['username']) && $_SESSION['role'] == 'administrator' ? '<span class="caret"></span>' : null ?>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#edit_profile" data-toggle="modal">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                                <a href="#changepass" data-toggle="modal">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Core</h4>
                </li>
                <li class="nav-item <?= $current_page == 'dashboard.php' || $current_page == 'resident_info.php' || $current_page == 'purok_info.php'  ? 'active' : null ?>">
                    <a href="dashboard.php">
                        <i class="fa fa-tasks"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- THIS IS FOR THE NOTICE under DASHBOARD -->
                <?php
                $query_zone = "SELECT * FROM tblpurok";
                $count_zone = $conn->query($query_zone)->num_rows;

                $query_householdnumber = "SELECT * FROM tbl_household";
                $count_householdnumber = $conn->query($query_householdnumber)->num_rows;

                $query_org = "SELECT * FROM tbl_org";
                $count_org = $conn->query($query_org)->num_rows;

                $query_position = "SELECT * FROM tblposition";
                $count_position = $conn->query($query_position)->num_rows;

                $query_chairmanship = "SELECT * FROM tblchairmanship";
                $count_chairmanship = $conn->query($query_chairmanship)->num_rows;

                $query_noc = "SELECT * FROM tbl_nature_of_case";
                $count_noc = $conn->query($query_noc)->num_rows;
                ?>
                <?php if ($count_zone == 0 || $count_householdnumber == 0 || $count_org == 0 || $count_position == 0 || $count_chairmanship == 0 || $count_noc == 0) : ?>

                    <?php if ($_SESSION['role'] == 'administrator') : ?>
                        <li class="nav-item <?= $current_page == 'organization_or_association.php' || $current_page == 'purok.php' || $current_page == 'position.php' || $current_page == 'chairmanship.php' || $current_page == 'precinct.php' || $current_page == 'users.php' || $current_page == 'support.php' || $current_page == 'backup.php' || $current_page == 'nature_of_case.php' || $current_page == 'household_number.php' ? 'active' : null ?>">
                            <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                <i class="icon-wrench"></i>
                                <p>Settings</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?= $current_page == 'purok.php' || $current_page == 'household_number.php' || $current_page == 'organization_or_association.php' || $current_page == 'nature_of_case.php' || $current_page == 'position.php'  || $current_page == 'precinct.php' || $current_page == 'chairmanship.php' || $current_page == 'users.php' || $current_page == 'support.php' || $current_page == 'backup.php' || $current_page == 'nature_of_case.php' ? 'show' : null ?>" id="settings">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="#restore" data-toggle="modal">
                                            <span class="sub-item">Restore</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>

                <?php else : ?>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Profiling</h4>
                    </li>
                    <li class="nav-item <?= $current_page == 'officials.php' ? 'active' : null ?>">
                        <a href="officials.php">
                            <i class="fa fa-users"></i>
                            <p>Brgy Officials and Staff</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page == 'resident2.php' || $current_page == 'generate_resident2.php' ? 'active' : null ?>">
                        <a href="resident2.php">
                            <i class="fa fa-user"></i>
                            <p>Resident Information</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Certificates</h4>
                    </li>

                    <li class="nav-item <?= $current_page == 'resident_certification.php' || $current_page == 'resident_indigency.php' || $current_page == 'resident_cert_of_oneness.php' || $current_page == 'certificate_appearance.php' || $current_page == 'business_permit.php' || $current_page == 'special_permit.php' ? 'active' : null ?>">
                        <a href="#certificates" data-toggle="collapse" class="collapsed" aria-expanded="false">
                            <i class="fa fa-certificate"></i>
                            <p>Certificates</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse <?= $current_page == 'resident_certification.php' || $current_page == 'resident_indigency.php' || $current_page == 'resident_cert_of_oneness.php' || $current_page == 'certificate_appearance.php' || $current_page == 'business_permit.php' || $current_page == 'special_permit.php' ? 'show' : null ?>" id="certificates">
                            <ul class="nav nav-collapse">

                                <li class="<?= $current_page == 'resident_certification.php' ? 'active' : null ?>">
                                    <a href="resident_certification.php">
                                        <p>Barangay Clearance</p>
                                    </a>
                                </li>

                                <li class="<?= $current_page == 'resident_indigency.php' || $current_page == 'generate_indi_cert.php' ? 'active' : null ?>">
                                    <a href="resident_indigency.php">
                                        <p>Certificate of Indigency</p>
                                    </a>
                                </li>

                                <li class="<?= $current_page == 'resident_cert_of_oneness.php' || $current_page == 'generate_cert_of_oneness.php' ? 'active' : null ?>">
                                    <a href="resident_cert_of_oneness.php">
                                        <p>Certificate of Oneness</p>
                                    </a>
                                </li>

                                <li class="<?= $current_page == 'certificate_appearance.php' || $current_page == 'generate_cert_appearance.php' ? 'active' : null ?>">
                                    <a href="certificate_appearance.php">
                                        <p>Certificate of Appearance</p>
                                    </a>
                                </li>

                                <li class="<?= $current_page == 'business_permit.php' || $current_page == 'generate_business_permit.php' ? 'active' : null ?>">
                                    <a href="business_permit.php">
                                        <p>Construction Clearance</p>
                                    </a>
                                </li>

                                <li class="<?= $current_page == 'special_permit.php' || $current_page == 'generate_special_permit.php' ? 'active' : null ?>">
                                    <a href="special_permit.php">
                                        <p>Special Permit</p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Others</h4>
                    </li>
                    <li class="nav-item <?= $current_page == 'blotter.php' || $current_page == 'generate_blotter_report.php'  ? 'active' : null ?>">
                        <a href="blotter.php">
                            <i class="icon-docs"></i>
                            <p>Blotter Records</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page == 'household.php' ? 'active' : null ?>">
                        <a href="household.php">
                            <i class="fa fa-home"></i>
                            <p>Household No.</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page == 'age-group.php' ? 'active' : null ?>">
                        <a href="age-group.php">
                            <i class="fas fa-sort-numeric-up"></i>
                            <p>Age Group</p>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'staff') : ?>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">System</h4>
                        </li>
                        <li class="nav-item">
                            <a href="#support" data-toggle="modal">
                                <i class="fas fa-flag"></i>
                                <p>Support</p>
                            </a>
                        </li>

                    <?php endif ?>

                    <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                        <li class="nav-item <?= $current_page == 'revenue.php' ? 'active' : null ?>">
                            <a href="revenue.php">
                                <i class="fa fa-plus"></i>
                                <p>Revenues</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $current_page == 'transactions.php' ? 'active' : null ?>">
                            <a href="transactions.php">
                                <i class="fa fa-bars"></i>
                                <p>Transactions</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $current_page == 'user_logs.php' ? 'active' : null ?>">
                            <a href="user_logs.php">
                                <i class="fas fa-history"></i>
                                <p>User Logs</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">System</h4>
                        </li>

                        <li class="nav-item <?= $current_page == 'organization_or_association.php' || $current_page == 'purok.php' || $current_page == 'position.php' || $current_page == 'chairmanship.php' || $current_page == 'precinct.php' || $current_page == 'users.php' || $current_page == 'support.php' || $current_page == 'backup.php' || $current_page == 'nature_of_case.php' || $current_page == 'officials_archives.php' || $current_page == 'household_number.php' ? 'active' : null ?>">
                            <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                <i class="icon-wrench"></i>
                                <p>Settings</p>
                                <?php if ($resultSupport > 0) : ?>
                                    <span class="badge badge-danger"><?= number_format($resultSupport) ?></span>
                                <?php endif ?>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?= $current_page == 'purok.php' || $current_page == 'household_number.php' || $current_page == 'organization_or_association.php' || $current_page == 'nature_of_case.php' || $current_page == 'position.php'  || $current_page == 'precinct.php' || $current_page == 'chairmanship.php' || $current_page == 'users.php' || $current_page == 'support.php' ||  $current_page == 'backup.php' || $current_page == 'officials_archives.php' || $current_page == 'nature_of_case.php' ? 'show' : null ?>" id="settings">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="#barangay" data-toggle="modal">
                                            <span class="sub-item">Barangay Info</span>
                                        </a>
                                    </li>
                                    <li class="<?= $current_page == 'purok.php' ? 'active' : null ?>">
                                        <a href="purok.php">
                                            <span class="sub-item">Zone</span>
                                        </a>
                                    </li>
                                    <li class="<?= $current_page == 'household_number.php' ? 'active' : null ?>">
                                        <a href="household_number.php">
                                            <span class="sub-item">Household Number</span>
                                        </a>
                                    </li>
                                    <li class="<?= $current_page == 'organization_or_association.php' ? 'active' : null ?>">
                                        <a href="organization_or_association.php">
                                            <span class="sub-item">Organization/Association</span>
                                        </a>
                                    </li>
                                    <!-- COMMENT THIS OUT if user wanted to have a precinct feature. A table exist for precinct -->
                                    <!-- <li class="<?= $current_page == 'precinct.php' ? 'active' : null ?>">
                                <a href="precinct.php">
                                    <span class="sub-item">Precinct</span>
                                </a>
                            </li> -->
                                    <li class="<?= $current_page == 'position.php' ? 'active' : null ?>">
                                        <a href="position.php">
                                            <span class="sub-item">Positions</span>
                                        </a>
                                    </li>
                                    <li class="<?= $current_page == 'chairmanship.php' ? 'active' : null ?>">
                                        <a href="chairmanship.php">
                                            <span class="sub-item">Chairmanship</span>
                                        </a>
                                    </li>
                                    <li class="<?= $current_page == 'nature_of_case.php' ? 'active' : null ?>">
                                        <a href="nature_of_case.php">
                                            <span class="sub-item">Nature of Case</span>
                                        </a>
                                    </li>

                                    <?php if ($_SESSION['role'] == 'staff') : ?>
                                        <li>
                                            <a href="#support" data-toggle="modal">
                                                <span class="sub-item">Support</span>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li class="<?= $current_page == 'users.php' ? 'active' : null ?>">
                                            <a href="users.php">
                                                <span class="sub-item">Users</span>
                                            </a>
                                        </li>
                                        <li class="<?= $current_page == 'support.php' ? 'active' : null ?>">
                                            <a href="support.php">
                                                <span class="sub-item">Support</span>
                                                <?php if ($resultSupport > 0) : ?>
                                                    <span class="badge badge-danger"><?= number_format($resultSupport) ?></span>
                                                <?php endif ?>
                                            </a>
                                        </li>
                                        <li class="<?= $current_page == 'officials_archives.php' ? 'active' : null ?>">
                                            <a href="officials_archives.php">
                                                <span class="sub-item">Officials archives</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="backup/backup.php">
                                                <span class="sub-item">Backup</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#restore" data-toggle="modal">
                                                <span class="sub-item">Restore</span>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>