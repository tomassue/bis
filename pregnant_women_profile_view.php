<?php include 'server/server.php' ?>

<?php

$sql = "SELECT * FROM tbl_p_fam_members JOIN tblresident2 ON tblresident2.id_resident=tbl_p_fam_members.id_resident";
$result = $conn->query($sql);
$fam_members = array();
while ($row = $result->fetch_assoc()) {
    $fam_members[] = $row;
}

/////////////////////////////////////////////////////////////////////////////////

$id = $_GET['id'];
// $query1 = "SELECT * FROM tblresident2 WHERE id_resident='$id'";
// $result1 = $conn->query($query1);
// $resident = $result1->fetch_assoc();

// $query2 = "SELECT * FROM tbl_p_fam_members WHERE id_resident='$id' AND family_role='mother'";
$query2 = "SELECT * FROM tbl_p_fam_members JOIN tblresident2 ON tblresident2.id_resident=tbl_p_fam_members.id_resident WHERE tbl_p_fam_members.id_resident='$id' AND tbl_p_fam_members.family_role='mother'";
$result2 = $conn->query($query2);
$mother_profile = $result2->fetch_assoc();

/////////////////////////////////////////////////////////////////////////////////

$family_number = $mother_profile['family_num'];
$query3 = "SELECT * FROM tbl_p_fam_members JOIN tblresident2 ON tblresident2.id_resident=tbl_p_fam_members.id_resident WHERE family_num='$family_number' AND family_role='father'";
$result_query3 = $conn->query($query3);
$count_father = $result_query3->num_rows;
$father_info = $result_query3->fetch_assoc();

$query4 = "SELECT * FROM tbl_p_fam_members JOIN tblresident2 ON tblresident2.id_resident=tbl_p_fam_members.id_resident WHERE family_num='$family_number' AND family_role='children'";
$result_query4 = $conn->query($query4);
$count_child = $result_query4->num_rows;
$child_info = array();
while ($row3 = $result_query4->fetch_assoc()) {
    $child_info[] = $row3;
}

$query5 = "SELECT * FROM tbl_p_emergency_contact WHERE family_num='$family_number'";
$result_query5 = $conn->query($query5);
$count_emergency_contact = $result_query5->num_rows;
$emergency_contact_info = $result_query5->fetch_assoc();

/////////////////////////////////////////////////////////////////////////////////

$queryResident = "SELECT * FROM tblresident2";
$resultResident = $conn->query($queryResident);
$getResident = array();
while ($row = $resultResident->fetch_assoc()) {
    $getResident[] = $row;
}

/////////////////////////////////////////////////////////////////////////////////

$queryHousehold = "SELECT * FROM tbl_household JOIN tblpurok ON tblpurok.id_purok=tbl_household.id_purok";
$resultHousehold = $conn->query($queryHousehold);
$getHousehold = array();
while ($row2 = $resultHousehold->fetch_assoc()) {
    $getHousehold[] = $row2;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
    <title>Barangay Pregnant Women - Barangay Management System</title>

    <!-- Select2 CSS -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="assets/css/select2.min.css" />
    <!-- <link rel="stylesheet" href="/path/to/select2.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
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
                                <h2 class="text-white fw-bold">Pregnant Women</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">

                            <!-- SESSION MESSAGE -->
                            <?php if (isset($_SESSION['message'])) : ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <!-- MOTHER CARD -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Mother's Profile</div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                            <div class="card-tools">
                                                <!-- <a href="#addmotherinfo" data-toggle="modal" class="btn btn-info btn-sm">
                                                    <i class="fa fa-plus"></i>&nbsp
                                                    Add a Mother
                                                </a> -->
                                                <!-- <a type="button" href="generate_officials.php" class="btn btn-sm btn-secondary" title="Print">
                                                    <i class="fas fa-print"></i>&nbsp Print
                                                </a> -->
                                                <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                    <!-- <a href="model/archive_officials.php" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to archive the BRGY OFFICIALS?')">
                                                        <i class="fas fa-file-archive"></i>&nbsp
                                                        Archive
                                                    </a> -->
                                                <?php endif; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <!-- MOTHER PROFILE -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="text-center p-1" style="border:1px solid red">
                                                <img src="<?= preg_match('/data:image/i', $mother_profile['picture']) ? $mother_profile['picture'] : 'assets/uploads/resident_profile/' . $mother_profile['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($mother_profile['firstname'] . ' ' . $mother_profile['middlename'] . ' ' . $mother_profile['lastname']) ?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthday:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($mother_profile['birthdate'])) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Phone:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $mother_profile['phone'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Blood Type:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $mother_profile['family_blood_type'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Occupation:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords(trim($mother_profile['occupation'])) ?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Address:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <?php
                                                        $h_id = $mother_profile['id_household'];
                                                        $queryHouseholdNumber = "SELECT * FROM tbl_household JOIN tblpurok ON tblpurok.id_purok=tbl_household.id_purok WHERE id_household='$h_id'";
                                                        $resultHouseholdNumber = $conn->query($queryHouseholdNumber);
                                                        $householdnum = $resultHouseholdNumber->fetch_assoc();
                                                        ?>
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords(trim($householdnum['purok_name'] . ', ' . $householdnum['household_street_name'] . ', ' . $householdnum['household_address'])) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FAMILY CARD -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Other Information</div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                            <!-- <div class="card-tools">
                                                <a href="#addmotherinfo" data-toggle="modal" class="btn btn-info btn-sm">
                                                    <i class="fa fa-plus"></i>&nbsp
                                                    Add
                                                </a>
                                                <a type="button" href="generate_officials.php" class="btn btn-sm btn-secondary" title="Print">
                                                    <i class="fas fa-print"></i>&nbsp Print
                                                </a>
                                                <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                    <a href="model/archive_officials.php" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to archive the BRGY OFFICIALS?')">
                                                        <i class="fas fa-file-archive"></i>&nbsp
                                                        Archive
                                                    </a>
                                                <?php endif; ?>
                                            </div> -->
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="accordion accordion-secondary">
                                        <!--FATHER-->
                                        <div class="card">
                                            <div class="card-header collapsed" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                <div class="span-icon">
                                                    <div class="flaticon-box-1"></div>
                                                </div>
                                                <div class="span-title">
                                                    Father
                                                </div>
                                                <div class="span-mode"></div>
                                            </div>
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?php if ($count_father == 0) : ?>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="#addfatherinfo" data-toggle="modal" class="btn btn-info btn-sm">
                                                                    <i class="fa fa-plus"></i>&nbsp
                                                                    Add
                                                                </a>
                                                            </div>
                                                        <?php endif ?>
                                                        <div class="d-flex justify-content-center">
                                                            <p>No record</p>
                                                        </div>
                                                    <?php else : ?>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="#editfatherinfo<?= $father_info['id_resident'] ?>" data-toggle="modal" class="btn btn-info btn-sm">
                                                                    <i class="fa fa-edit"></i>&nbsp
                                                                    Edit
                                                                </a>
                                                            </div>
                                                            <?php include 'p_edit_father.php'; ?>
                                                        <?php endif ?>
                                                        <div class="row mb-5">
                                                            <div class="col-md-3">
                                                                <div class="text-center p-1" style="border:1px solid red">
                                                                    <img src="<?= preg_match('/data:image/i', $father_info['picture']) ? $father_info['picture'] : 'assets/uploads/resident_profile/' . $father_info['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($father_info['firstname'] . ' ' . $father_info['middlename'] . ' ' . $father_info['lastname']) ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthday:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($father_info['birthdate'])) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Phone:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $father_info['phone'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Blood Type:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $father_info['family_blood_type'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Occupation:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords(trim($father_info['occupation'])) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!--CHILDREN-->
                                        <div class="card">
                                            <div class="card-header collapsed" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <div class="span-icon">
                                                    <div class="flaticon-box-1"></div>
                                                </div>
                                                <div class="span-title">
                                                    Children
                                                </div>
                                                <div class="span-mode"></div>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?php if ($count_child == 0) : ?>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="#addchildreninfo" data-toggle="modal" class="btn btn-info btn-sm">
                                                                    <i class="fa fa-plus"></i>&nbsp
                                                                    Add
                                                                </a>
                                                            </div>
                                                        <?php endif ?>
                                                        <div class="d-flex justify-content-center">
                                                            <p>No record</p>
                                                        </div>
                                                    <?php else : ?>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <div class="d-flex justify-content-end">
                                                                <div class="m-1">
                                                                    <a href="#editchildreninfo<?= $mother_profile['family_num'] ?>" data-toggle="modal" class="btn btn-info btn-sm">
                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                        Edit
                                                                    </a>
                                                                    <?php include 'p_edit_children.php' ?>
                                                                </div>

                                                            </div>
                                                        <?php endif ?>
                                                        <?php foreach ($child_info as $row3) : ?>
                                                            <div class="row mb-5">
                                                                <div class="col-md-3">
                                                                    <div class="text-center p-1" style="border:1px solid red">
                                                                        <img src="<?= preg_match('/data:image/i', $row3['picture']) ? $row3['picture'] : 'assets/uploads/resident_profile/' . $row3['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($row3['firstname'] . ' ' . $row3['middlename'] . ' ' . $row3['lastname']) ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthday:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($row3['birthdate'])) ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Phone:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $row3['phone'] ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Blood Type:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $row3['family_blood_type'] ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Occupation:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords(trim($row3['occupation'])) ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!--EMERGENCY CONTACT-->
                                        <div class="card">
                                            <div class="card-header collapsed" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <div class="span-icon">
                                                    <div class="flaticon-box-1"></div>
                                                </div>
                                                <div class="span-title">
                                                    Emergency Contact
                                                </div>
                                                <div class="span-mode"></div>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?php if ($count_emergency_contact == 0) : ?>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="#addemergencycontactinfo" data-toggle="modal" class="btn btn-info btn-sm">
                                                                    <i class="fa fa-plus"></i>&nbsp
                                                                    Add
                                                                </a>
                                                            </div>
                                                        <?php endif ?>
                                                        <div class="d-flex justify-content-center">
                                                            <p>No record</p>
                                                        </div>
                                                    <?php else : ?>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="#editemergencycontactinfo<?= $emergency_contact_info['id_p_emergency_contact'] ?>" data-toggle="modal" class="btn btn-info btn-sm">
                                                                    <i class="fa fa-edit"></i>&nbsp
                                                                    Edit
                                                                </a>
                                                                <?php include 'p_edit_emergency_contact.php'; ?>
                                                                &nbsp; &nbsp;
                                                                <a href="model/remove_p_emergency_contact_information.php?em_id=<?= $emergency_contact_info['id_p_emergency_contact'] ?>&mother_id=<?= $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove the emergency contact information?');">
                                                                    <i class="fas fa-minus"></i>&nbsp
                                                                    Remove
                                                                </a>
                                                            </div>
                                                        <?php endif ?>
                                                        <div class="row mb-5">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($emergency_contact_info['emergency_name']) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Kaugnayan:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $emergency_contact_info['emergency_relationship'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthday:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($emergency_contact_info['emergency_bday'])) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Cellphone:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $emergency_contact_info['emergency_cellphone'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Landline:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $emergency_contact_info['emergency_landline'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
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


            <!-- Add Father modal -->
            <div class="modal fade bd-example-modal-lg" id="addfatherinfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Father</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="bodyadd">
                            <form method="POST" action="model/save_p_father_information.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                                <label><b>I. </b>FATHER'S INFORMATION</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father</label>
                                            <select class="form-control js-states" style="width:100%;" id="father" name="id_resident" required>
                                                <?php foreach ($getResident as $row) : ?>
                                                    <option value=""></option>
                                                    <option value="<?= $row['id_resident'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?> </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birthday</label>
                                            <input type="text" class="form-control" id="f_birthdate" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cellphone (kung meron)</label>
                                            <input type="text" class="form-control" id="f_phone" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blood Type</label>
                                            <input type="text" class="form-control" name="blood_type">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trabaho</label>
                                            <input type="text" class="form-control" id="f_occupation" disabled>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <div class="modal-footer">
                                <input type="hidden" value="father" name="family_role">
                                <input type="hidden" value="<?= $mother_profile['family_num'] ?>" name="family_num">
                                <input type="hidden" value="<?= $id ?>" name="mother_id">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Children modal -->
            <div class="modal fade bd-example-modal-lg" id="addchildreninfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Children</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="bodyadd">
                            <form method="POST" action="model/save_p_children_information.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                                <label><b>II. </b>CHILDREN'S INFORMATION</label>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Anak</label>
                                        <select class="js-example-basic-multiple" name="id_resident[]" multiple="multiple">
                                            <?php foreach ($getResident as $row) : ?>
                                                <option value="<?= $row['id_resident'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <div class="modal-footer">
                                <input type="hidden" value="children" name="family_role">
                                <input type="hidden" value="<?= $mother_profile['family_num'] ?>" name="family_num">
                                <input type="hidden" value="<?= $id ?>" name="mother_id">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Emergency contact modal -->
            <div class="modal fade bd-example-modal-lg" id="addemergencycontactinfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Emergency contat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="bodyadd">
                            <form method="POST" action="model/save_p_emergency_contact.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                                <label><b>III. </b>EMERGENCY CONTACT</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pangalan</label>
                                            <input type="text" class="form-control" name="emergency_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kaugnayan</label>
                                            <input type="text" class="form-control" name="emergency_relationship">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birthday</label>
                                            <input type="date" class="form-control" name="emergency_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cellphone (kung meron)</label>
                                            <input type="text" class="form-control" name="emergency_cp">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Landline (kung meron)</label>
                                            <input type="text" class="form-control" name="emergency_landline">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <div class="modal-footer">
                                <input type="hidden" value="<?= $mother_profile['family_num'] ?>" name="family_num">
                                <input type="hidden" value="<?= $id ?>" name="mother_id">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        var table = $('#pregnantwomen').DataTable({
            "order": [
                [0, "desc"]
            ]
        });

        // START SELECT
        $("#father").select2({
            theme: "bootstrap4",
            placeholder: "Select Father",
            allowClear: true,
            dropdownParent: $('#bodyadd')
        });

        $("#editfather").select2({
            theme: "bootstrap4",
            placeholder: "Select Father",
            allowClear: true,
            dropdownParent: $('#bodyedit')
        });

        $("#id_household").select2({
            theme: "bootstrap4",
            placeholder: "Select Household",
            allowClear: true,
            dropdownParent: $('#bodyadd')
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        // END SELECT2

        // Listen for changes in the select option
        $('#father').on('change', function() {
            // Get the selected value
            var id = $(this).val();

            // Make an AJAX call to the PHP script
            $.ajax({
                url: 'get_resident_info.php',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    // Populate the input fields with the retrieved data
                    $('#f_birthdate').val(data.birthdate);
                    $('#f_phone').val(data.phone);
                    $('#f_occupation').val(data.occupation);
                }
            });
        });

        // Listen for changes in the select option
        $('#editfather').on('change', function() {
            // Get the selected value
            var id = $(this).val();

            // Make an AJAX call to the PHP script
            $.ajax({
                url: 'get_resident_info.php',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    // Populate the input fields with the retrieved data
                    $('#f_birthdate').val(data.birthdate);
                    $('#f_phone').val(data.phone);
                    $('#f_occupation').val(data.occupation);
                }
            });
        });

        // add row
        // $("#addRow").click(function() {
        //     var html = '';
        //     html += '<div id="inputFormRow">';
        //     html += '<div class="row">';
        //     html += '<div class="col-md-6">';
        //     html += '<div class="form-group">';
        //     html += '<label>Anak</label>';
        //     html += '<select class="form-control js-states  " style="width:100%;" id="child" name="child" required>';
        //     html += '<?php foreach ($getResident as $row) : ?>';
        //     html += '<option value=""></option>';
        //     html += '<option value="<?= $row['id_resident'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?> </option>';
        //     html += '<?php endforeach ?>';
        //     html += '</select>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '<div class="col-md-6">';
        //     html += '<div class="form-group">';
        //     html += '<label>Birthday</label>';
        //     html += '<div class="input-group">';
        //     html += '<input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" disabled>';
        //     html += '<div class="input-group-prepend">';
        //     html += '<button class="btn btn-default btn-danger" type="button" id="removeRow">Remove</button>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '</div>';

        //     $('#newRow').append(html);
        // });

        // remove row
        // $(document).on('click', '#removeRow', function() {
        //     $(this).closest('#inputFormRow').remove();
        // });
    </script>
</body>

</html>