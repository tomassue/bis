<?php include 'server/server.php' ?>
<?php

//"SELECT *, tblresident.id as id, tblpurok.id as purok_id, tbl_org.id as org_id FROM tblresident JOIN tblpurok ON tblpurok.id=tblresident.purok JOIN tbl_org ON tbl_org.id=tblresident.organization ";

$state = $_GET['state'];

if ($state == 'male') {
    // $query = "SELECT * FROM tblresident WHERE sex='Male' AND resident_type=1";
    // $result = $conn->query($query);
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.sex='Male' AND tblresident2.resident_type=1";
    $result = $conn->query($query);
} elseif ($state == 'female') {
    // $query = "SELECT * FROM tblresident WHERE sex='Female' AND resident_type=1";
    // $result = $conn->query($query);
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.sex='Female' AND tblresident2.resident_type=1";
    $result = $conn->query($query);
} elseif ($state == 'non_voters') {
    /*$query = "SELECT * FROM tblresident WHERE voterstatus='No' AND resident_type=1";
        $result = $conn->query($query);*/
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='No' AND tblresident2.resident_type=1";
    $result = $conn->query($query);
} elseif ($state == 'voters') {
    /*$query = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND resident_type=1";
        $result = $conn->query($query);*/
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='Yes' AND tblresident2.resident_type=1";
    $result = $conn->query($query);

    // $query1 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND identified_as='Positive' AND resident_type=1";
    $query1 = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='Yes' AND tblresident2.identified_as='Confirmed' AND tblresident2.resident_type=1";
    $pos = $conn->query($query1)->num_rows;

    // $query2 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND identified_as='Negative' AND resident_type=1";
    $query2 = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='Yes' AND tblresident2.identified_as='Unconfirmed' AND tblresident2.resident_type=1";
    $nega = $conn->query($query2)->num_rows;
} elseif ($state == 'senior-citizens') {
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.id_org=1 AND tblresident2.resident_type=1";
    $result = $conn->query($query);
} elseif ($state == 'pwd') {
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.pwd='Yes'";
    $result = $conn->query($query);
} elseif ($state == 'deceased') {
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.resident_type=0"; //SHOWS 0 (deceased)
    $result = $conn->query($query);
} elseif ($state == 'indigent') {
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.indigent='Yes'";
    $result = $conn->query($query);
} else {
    $query = "SELECT * FROM tblresident2";
    $result = $conn->query($query);
}

$result = $conn->query($query);
$resident = array();
while ($row = $result->fetch_assoc()) {
    $resident[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>
        <?php if ($state == 'male') : ?>
            Resident Information (Male) - Barangay Management System
        <?php elseif ($state == 'female') : ?>
            Resident Information (Female) - Barangay Management System
        <?php elseif ($state == 'non_voters') : ?>
            Resident Information (Non-voters) - Barangay Management System
        <?php elseif ($state == 'voters') : ?>
            Resident Information (Voters) - Barangay Management System
        <?php elseif ($state == 'senior-citizens') : ?>
            Resident Information (Senior Citizens) - Barangay Management System
        <?php elseif ($state == 'pwd') : ?>
            Resident Information (PWDs) - Barangay Management System
        <?php elseif ($state == 'deceased') : ?>
            Resident Information (Deceased) - Barangay Management System
        <?php elseif ($state == 'indigent') : ?>
            Resident Information (Indigent) - Barangay Management System
        <?php else : ?>
            Resident Information - Barangay Management System
        <?php endif ?>
    </title>
    <link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
</head>

<body>
    <?php include 'templates/loading_screen.php' ?>
    <div class="wrapper">
        <!-- Main Header -->
        <?php include 'templates/main-header.php' ?>
        <!-- End Main Header -->

        <!-- Sidebar -->
        <?php include 'templates/sidebar.php' ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-dark-gradient">
                    <div class="page-inner">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white fw-bold"><?php if ($state == 'voters') {
                                                                    echo 'Voters Information';
                                                                } elseif ($state == 'non_voters') {
                                                                    echo 'Voters Information';
                                                                } else {
                                                                    echo 'Resident Information';
                                                                } ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif ?>
                    <?php if ($state == 'voters' && isset($_SESSION['role']) && isset($_SESSION['role']) == 'administrator') : ?>
                        <div class="row mt--2">
                            <div class="col">
                                <div class="card card-stats card-round" style="background-color:black;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-fingerprint" style="color:white;"></i>
                                                </div>
                                            </div>
                                            <div class="col-3 col-stats">
                                            </div>
                                            <div class="col-6 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category" style="color:white;">All Voters</p>
                                                    <h4 class="card-title" style="color:white;"><?= number_format(count($resident)) ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-stats card-round" style="background-color:black;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-fingerprint" style="color:white;"></i>
                                                </div>
                                            </div>
                                            <div class="col-3 col-stats">
                                            </div>
                                            <div class="col-6 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category" style="color:white;">Confirmed Voters</p>
                                                    <h4 class="card-title" style="color:white;"><?= number_format($pos) ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-stats card-round" style="background-color:black;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-fingerprint" style="color:white;"></i>
                                                </div>
                                            </div>
                                            <div class="col-3 col-stats">
                                            </div>
                                            <div class="col-6 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category" style="color:white;">Unconfirmed Voters</p>
                                                    <h4 class="card-title" style="color:white;"><?= number_format($nega) ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--NEED FIXING-->
                            <!-- <div class="col">
                            <div class="card card-stats card-danger card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center"> 
                                                <i class="fas fa-fingerprint"></i>
                                            </div>
                                        </div>
                                        <div class="col-3 col-stats">
                                        </div>
                                        <div class="col-6 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Non Voters</p>
                                                <h4 class="card-title"><?= number_format($non) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        </div>

                    <?php endif ?>
                    <?php if ($state != 'voters') : ?>
                        <div class="col-md-3">
                            <div class="card card-stats card-round" <?php
                                                                    if ($state == 'male') {
                                                                        echo 'style="background-color:black;"';
                                                                    } elseif ($state == 'female') {
                                                                        echo 'style="background-color:black;"';
                                                                    } elseif ($state == 'voters') {
                                                                        echo 'style="background-color:black;"';
                                                                    } elseif ($state == 'non_voters') {
                                                                        echo 'style="background-color:black;"';
                                                                    } elseif ($state == 'senior-citizens') {
                                                                        echo 'style="background-color:black;"';
                                                                    } elseif ($state == 'pwd') {
                                                                        echo 'style="background-color:black;"';
                                                                    } elseif ($state == 'deceased') {
                                                                        echo 'style="background-color:black;"';
                                                                    } elseif ($state == 'indigent') {
                                                                        echo 'style="background-color:black;"';
                                                                    } else {
                                                                        echo 'style="background-color:black;"';
                                                                    } ?>>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <?php
                                                if ($state == 'male') {
                                                    echo '<i class="flaticon-user" style="color:white;"></i>';
                                                } elseif ($state == 'female') {
                                                    echo ' <i class="icon-user-female" style="color:white;"></i>';
                                                } elseif ($state == 'voters') {
                                                    echo ' <i class="fas fa-fingerprint" style="color:white;"></i>';
                                                } elseif ($state == 'non_voters') {
                                                    echo ' <i class="fas fa-fingerprint" style="color:white;"></i>';
                                                } elseif ($state == 'senior-citizens') {
                                                    echo ' <i class="flaticon-users" style="color:white;"></i>';
                                                } elseif ($state == 'pwd') {
                                                    echo ' <i class="fa fa-blind" style="color:white;"></i>';
                                                } elseif ($state == 'deceased') {
                                                    echo ' <i class="fa fa-people-carry" style="color:white;"></i>';
                                                } elseif ($state == 'indigent') {
                                                    echo ' <i class="fas fa-user-friends" style="color:white;"></i>';
                                                } else {
                                                    echo '<i class="flaticon-users" style="color:white;"></i>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-4 col-stats">
                                        </div>
                                        <div class="col-5 col-stats">
                                            <div class="numbers">
                                                <p class="card-category" style="color:white;">
                                                    <?php
                                                    if ($state == 'male') {
                                                        echo 'All Male Residents';
                                                    } elseif ($state == 'female') {
                                                        echo 'All Female Residents';
                                                    } elseif ($state == 'voters') {
                                                        echo 'All Voters';
                                                    } elseif ($state == 'non_voters') {
                                                        echo 'All Non Voters';
                                                    } elseif ($state == 'senior-citizens') {
                                                        echo 'All Senior Citizens';
                                                    } elseif ($state == 'pwd') {
                                                        echo 'All PWDs';
                                                    } elseif ($state == 'deceased') {
                                                        echo 'All Deceased Residents';
                                                    } elseif ($state == 'indigent') {
                                                        echo 'All Indigenous Residents';
                                                    } else {
                                                        echo 'All Residents';
                                                    }
                                                    ?>
                                                </p>
                                                <h4 class="card-title" style="color:white;"><?= number_format(count($resident)) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="row mt--2">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">
                                            <?php
                                            if ($state == 'male') {
                                                echo 'All Male Residents';
                                            } elseif ($state == 'female') {
                                                echo 'All Female Residents';
                                            } elseif ($state == 'voters') {
                                                echo 'All Voters';
                                            } elseif ($state == 'non_voters') {
                                                echo 'All Non Voters';
                                            } elseif ($state == 'senior-citizens') {
                                                echo 'All Senior Citizens';
                                            } elseif ($state == 'pwd') {
                                                echo 'All PWDs';
                                            } elseif ($state == 'deceased') {
                                                echo 'All Deceased';
                                            } else {
                                                echo 'All Residents';
                                            }
                                            ?>
                                        </div>
                                        <div class="card-tools">
                                            <?php if ($state == 'male') : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=male'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php elseif ($state == 'female') : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=female'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php elseif ($state == 'non_voters') : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=non_voters'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php elseif ($state == 'voters') : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=voters'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php elseif ($state == 'senior-citizens') : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=senior-citizens'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php elseif ($state == 'pwd') : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=pwd'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php elseif ($state == 'deceased') : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=deceased'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php elseif ($state == 'indigent') : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=indigent'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php else : ?>
                                                <button class="btn btn-info btn-sm" onclick="location.href='generate_resident_info2.php?state=all'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="residenttable" class="display table table-striped">
                                            <thead>
                                                <tr>

                                                    <th scope="col">No.</th>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Civil Status</th>
                                                    <?php if ($state == 'male') : ?>

                                                    <?php elseif ($state == 'female') : ?>

                                                    <?php elseif ($state == 'non_voters') : ?>
                                                        <th scope='col'>Sex</th>
                                                    <?php elseif ($state == 'voters') : ?>
                                                        <th scope='col'>Sex</th>
                                                    <?php elseif ($state == 'all' || $state == 'senior-citizens') : ?>
                                                        <th scope='col'>Sex</th>
                                                    <?php endif ?>
                                                    <th scope="col">Address</th>
                                                    <?php if ($state == 'male') : ?>
                                                        <th scope="col">Voter Status</th>
                                                        <th scope="col">Identified As</th>
                                                    <?php elseif ($state == 'female') : ?>
                                                        <th scope="col">Voter Status</th>
                                                        <th scope="col">Identified As</th>
                                                    <?php elseif ($state == 'voters') : ?>
                                                        <th scope="col">Voter Status</th>
                                                        <th scope="col">Identified As</th>
                                                    <?php elseif ($state == 'all' || $state == 'senior-citizens') : ?>
                                                        <th scope="col">Voter Status</th>
                                                        <th scope="col">Identified As</th>
                                                    <?php elseif ($state == 'non_voters') : ?>

                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($resident)) : ?>
                                                    <?php $no = 1;
                                                    foreach ($resident as $row) : ?>
                                                        <tr>

                                                            <td><?= $no ?></td>

                                                            <td>
                                                                <div class="avatar avatar-xs">
                                                                    <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                                </div>
                                                                <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
                                                            </td>
                                                            <td><?= $row['birthdate'] ?></td>
                                                            <?php

                                                            $bday = new DateTime($row['birthdate']); // Your date of birth
                                                            $today = new Datetime(date('y.m.d'));
                                                            $diff = $bday->diff($today);

                                                            //Calculation for Age
                                                            $final_age = $diff->y;

                                                            ?>
                                                            <td><?php echo $final_age; ?></td>
                                                            <td><?= ucwords($row['civilstatus']) ?></td>

                                                            <?php if ($state == 'male') : ?>

                                                            <?php elseif ($state == 'female') : ?>

                                                            <?php elseif ($state == 'non_voters') : ?>
                                                                <td><?= $row['sex'] ?></td>
                                                            <?php elseif ($state == 'voters') : ?>
                                                                <td><?= $row['sex'] ?></td>
                                                            <?php elseif ($state == 'all' || $state == 'senior-citizens') : ?>
                                                                <td><?= $row['sex'] ?></td>
                                                            <?php endif ?>
                                                            <td>
                                                                <?php
                                                                $h_id = $row['id_household'];
                                                                $queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$h_id'";
                                                                $resultHouseholdNumber = $conn->query($queryHouseholdNumber);
                                                                $householdnum = $resultHouseholdNumber->fetch_assoc();

                                                                $p_name = $householdnum['id_purok'];
                                                                $queryPurokName = "SELECT * FROM tblpurok WHERE id_purok='$p_name'";
                                                                $resultPurokName = $conn->query($queryPurokName);
                                                                $pname = $resultPurokName->fetch_assoc();

                                                                echo $householdnum['household_street_name'] . ', ' . $pname['purok_name'] . ', ' . $householdnum['household_address'] . ', ' . $brgy;
                                                                ?>
                                                            </td>
                                                            <?php if ($state == 'male') : ?>
                                                                <td><?= $row['vstatus'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if (empty($row['identified_as'])) {
                                                                        echo "N/A";
                                                                    } elseif (!empty($row['identified_as'])) {
                                                                        echo $row['identified_as'];
                                                                    }
                                                                    ?>
                                                                </td>
                                                            <?php elseif ($state == 'female') : ?>
                                                                <td><?= $row['vstatus'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if (empty($row['identified_as'])) {
                                                                        echo "N/A";
                                                                    } elseif (!empty($row['identified_as'])) {
                                                                        echo $row['identified_as'];
                                                                    }
                                                                    ?>
                                                                </td>
                                                            <?php elseif ($state == 'voters') : ?>
                                                                <td><?= $row['vstatus'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if (empty($row['identified_as'])) {
                                                                        echo "N/A";
                                                                    } elseif (!empty($row['identified_as'])) {
                                                                        echo $row['identified_as'];
                                                                    }
                                                                    ?>
                                                                </td>
                                                            <?php elseif ($state == 'all' || $state == 'senior-citizens') : ?>
                                                                <td><?= $row['vstatus'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if (empty($row['identified_as'])) {
                                                                        echo "N/A";
                                                                    } elseif (!empty($row['identified_as'])) {
                                                                        echo $row['identified_as'];
                                                                    }
                                                                    ?>
                                                                </td>
                                                            <?php elseif ($state == 'non_voters') : ?>

                                                            <?php endif ?>
                                                        </tr>
                                                    <?php $no++;
                                                    endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>

                                                    <th scope="col">No.</th>

                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Civil Status</th>

                                                    <?php if ($state == 'male') : ?>

                                                    <?php elseif ($state == 'female') : ?>

                                                    <?php elseif ($state == 'non_voters') : ?>
                                                        <th scope='col'>sex</th>
                                                    <?php elseif ($state == 'voters') : ?>
                                                        <th scope='col'>sex</th>
                                                    <?php elseif ($state == 'all' || $state == 'senior-citizens') : ?>
                                                        <th scope='col'>sex</th>
                                                    <?php endif ?>
                                                    <th scope="col">Address</th>
                                                    <?php if ($state == 'male') : ?>
                                                        <th scope="col">Voter Status</th>
                                                        <th scope="col">Identified As</th>
                                                    <?php elseif ($state == 'female') : ?>
                                                        <th scope="col">Voter Status</th>
                                                        <th scope="col">Identified As</th>
                                                    <?php elseif ($state == 'voters') : ?>
                                                        <th scope="col">Voter Status</th>
                                                        <th scope="col">Identified As</th>
                                                    <?php elseif ($state == 'all' || $state == 'senior-citizens') : ?>
                                                        <th scope="col">Voter Status</th>
                                                        <th scope="col">Identified As</th>
                                                    <?php elseif ($state == 'non_voters') : ?>

                                                    <?php endif ?>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Main Footer -->
            <?php include 'templates/main-footer.php' ?>
            <!-- End Main Footer -->

        </div>

    </div>
    <?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="assets/js/plugin/moment/moment.min.js"></script>
    <script src="assets/js/plugin/dataTables.dateTime.min.js"></script>
    <script src="assets/js/plugin/datatables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/plugin/datatables/Buttons-1.6.1/js/buttons.print.min.js"></script>

    <!-- START ONLINE DATATABLES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>
    <!-- END ONLINE DATATABLES -->

    <script>
        // $(document).ready(function() {
        //     $('#residenttable').DataTable();
        // });

        $(document).ready(function() {
            $('#residenttable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel'
                ]
            });
        });
    </script>
</body>

</html>