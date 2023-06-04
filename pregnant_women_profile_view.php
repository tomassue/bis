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

//This QUERY is for the multi-select that will only provide options to those residents who are not saved to the tbl_p_fam_members.
$queryRID = "SELECT * FROM tblresident2 WHERE id_resident NOT IN (SELECT id_resident FROM tbl_p_fam_members)";
$resultRID = $conn->query($queryRID);
$getRID = array();
while ($row = $resultRID->fetch_assoc()) {
    $getRID[] = $row;
}

/////////////////////////////////////////////////////////////////////////////////

$queryHousehold = "SELECT * FROM tbl_household JOIN tblpurok ON tblpurok.id_purok=tbl_household.id_purok";
$resultHousehold = $conn->query($queryHousehold);
$getHousehold = array();
while ($row2 = $resultHousehold->fetch_assoc()) {
    $getHousehold[] = $row2;
}

/////////////////////////////////////////////////////////////////////////////////

$queryhcpc = "SELECT * FROM tbl_p_history_and_current_pregnancy_condition WHERE `id_resident` = '$id'";
$resulthcpc = $conn->query($queryhcpc)->num_rows;
$gethcpc = $conn->query($queryhcpc)->fetch_assoc();

/////////////////////////////////////////////////////////////////////////////////

$hcpc_id = $gethcpc['id_mother_h_c_pregnancy_condition'];

$queryImmunization = "SELECT * FROM tbl_p_immunization_record JOIN tbl_p_tetanus_vaccine ON tbl_p_tetanus_vaccine.tetanus_containing_vaccine=tbl_p_immunization_record.tetanus_containing_vaccine WHERE `id_mother_h_c_pregnancy_condition` = $hcpc_id ORDER BY tbl_p_tetanus_vaccine.tetanus_containing_vaccine_detail";
$getImmunization = $conn->query($queryImmunization);
$immunizationDetails = array();
while ($row = $getImmunization->fetch_assoc()) {
    $immunizationDetails[] = $row;
}

$queryTetanusVac = "SELECT * FROM tbl_p_tetanus_vaccine";
$resultTetanusVac = $conn->query($queryTetanusVac);
$tetanusVac = array();
while ($row = $resultTetanusVac->fetch_assoc()) {
    $tetanusVac[] = $row;
}

//Fethc tetanus vaccine option that has not been selected yet.
$queryTV = "SELECT * FROM tbl_p_tetanus_vaccine WHERE tetanus_containing_vaccine NOT IN (SELECT tetanus_containing_vaccine FROM tbl_p_immunization_record WHERE id_mother_h_c_pregnancy_condition = '$hcpc_id')";
$resultTV = $conn->query($queryTV);
$getTV = array();
while ($row = $resultTV->fetch_assoc()) {
    $getTV[] = $row;
}

/////////////////////////////////////////////////////////////////////////////////

$query1Trimester = "SELECT * FROM tbl_p_trimester WHERE `id_mother_h_c_pregnancy_condition` ='$hcpc_id'";
$result1Trimester = $conn->query($query1Trimester);
$count1Trimester = $result1Trimester->num_rows;

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
                                                <div class="col-lg">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($mother_profile['firstname'] . ' ' . $mother_profile['middlename'] . ' ' . $mother_profile['lastname']) ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthday:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($mother_profile['birthdate'])) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Phone:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $mother_profile['phone'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Blood Type:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $mother_profile['family_blood_type'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Occupation:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords(trim($mother_profile['occupation'])) ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg">
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
                                                    <div class="flaticon-user-4"></div>
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
                                                        <div class=text-center">
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
                                                            <br>
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
                                                                    <div class="col-lg">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($father_info['firstname'] . ' ' . $father_info['middlename'] . ' ' . $father_info['lastname']) ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthday:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($father_info['birthdate'])) ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Phone:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $father_info['phone'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg">
                                                                        <div class="form-group row">
                                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Blood Type:</h3>
                                                                        </div>
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $father_info['family_blood_type'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg">
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
                                                    <div class="flaticon-user-4"></div>
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
                                                        <div class="text-center">
                                                            <p>No record</p>
                                                        </div>
                                                    <?php else : ?>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <?php if (isset($_SESSION['username'])) : ?>
                                                                <div class="d-flex justify-content-end">
                                                                    <a href="#addchildreninfo2.0" data-toggle="modal" class="btn btn-info btn-sm">
                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                        Add
                                                                    </a>
                                                                </div>
                                                                <br>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                        <?php foreach ($child_info as $row3) : ?>
                                                            <div class="row mb-5">
                                                                <div class="col-md-3">
                                                                    <div class="text-center p-1" style="border:1px solid red">
                                                                        <img src="<?= preg_match('/data:image/i', $row3['picture']) ? $row3['picture'] : 'assets/uploads/resident_profile/' . $row3['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                                                    </div><br>
                                                                    <div>
                                                                        <a href="model/remove_p_child_information.php?child_id=<?= $row3['id_resident'] ?>&mother_id=<?= $id ?>" class="btn btn-danger btn-sm" style="width: 100%;" onclick="return confirm('Are you sure you want to proceed? This cannot be undone.')">
                                                                            <i class="fa fa-minus"></i>&nbsp
                                                                            Remove
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div class="row">
                                                                        <div class="col-lg">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($row3['firstname'] . ' ' . $row3['middlename'] . ' ' . $row3['lastname']) ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthday:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($row3['birthdate'])) ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Phone:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $row3['phone'] ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg">
                                                                            <div class="form-group row">
                                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Blood Type:</h3>
                                                                            </div>
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $row3['family_blood_type'] ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg">
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
                                                            <hr>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!--EMERGENCY CONTACT-->
                                        <div class="card">
                                            <div class="card-header collapsed" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <div class="span-icon">
                                                    <div class="flaticon-user-4"></div>
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
                                                        <div class="text-center">
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

                            <!-- Kasalukuyan at Nakaraang Kondisyon Habang Nagbubuntis card -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card full-height">
                                        <div class="card-header">
                                            <div class="card-head-row">
                                                <div class="card-title d-inline-block text-truncate"><span title="Kalagayan ng Kalusugan (Nutritional status based on Body Mass Index)">Kasalukuyan at Nakaraang Kondisyon Habang Nagbubuntis</span></div>
                                                <?php if (isset($_SESSION['username'])) : ?>
                                                    <div class="card-tools">
                                                        <?php if ($resulthcpc == 1) : ?>
                                                            <a href="#edithcpc<?= $gethcpc['id_mother_h_c_pregnancy_condition'] ?>" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                <i class="fa fa-edit"></i>&nbsp
                                                                Edit
                                                            </a>
                                                            <?php include 'p_edit_hcpc.php'; ?>
                                                        <?php elseif ($resulthcpc == 0) : ?>
                                                            <a href="#addhcpc" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                <i class="fa fa-plus"></i>&nbsp
                                                                Add
                                                            </a>
                                                        <?php endif ?>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($resulthcpc == 1) : ?>
                                                <div class="row mb-2">
                                                    <div class="col-sm">
                                                        <p class="fw-bold">Petsa ng unang checkup:</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <input type="text" class="form-control" value="<?= date("F j, Y", strtotime($gethcpc['first_check_up_date'])) ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm">
                                                        <p class="fw-bold">Edad (Age):</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <?php
                                                        $bdate = $mother_profile['birthdate'];
                                                        $dob = new DateTime($bdate);
                                                        $now = new DateTime();
                                                        $diff = $now->diff($dob);
                                                        ?>
                                                        <input type="text" class="form-control" value="<?= $diff->y . ' ' . 'years old' ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm">
                                                        <p class="fw-bold">Timbang (weight):</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <!-- <input type="text" class="form-control" value="<?= rtrim($gethcpc['p_weight'], "0") ?>"> -->
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="p_height" value="<?= rtrim($gethcpc['p_weight'], ".0") ?>">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon3">kg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm">
                                                        <p class="fw-bold">Taas (height):</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="p_height" value="<?= $gethcpc['p_height'] * 0.01 ?>">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon3">m</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm">
                                                        <p class="fw-bold">Kalagayan ng Kalusugan (Nutritional status based on Body Max Index):</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <input type="text" class="form-control" value="<?= rtrim($gethcpc['health_condition'], ".0") ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm">
                                                        <p class="fw-bold">Petsa ng huling regla (Date of last menstrual period):</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <input type="text" class="form-control" value="<?= date("F j, Y", strtotime($gethcpc['last_mens_period_date'])) ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm">
                                                        <p class="fw-bold">Kailan ako manganganak? (Expected date of delivery):</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <input type="text" class="form-control" value="<?= date("F j, Y", strtotime($gethcpc['expected_date_delivery'])) ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm">
                                                        <p class="fw-bold">No. of Pregnancy:</p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <input type="text" class="form-control" value="<?= $count_child + 1 ?>">
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="text-center">
                                                    <p>No record to show</p>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Immunization Record -->
                                <div class="col-md-8">
                                    <div class="card full-height">
                                        <div class="card-header">
                                            <div class="card-head-row">
                                                <div class="card-title">Immunization Record</div>
                                                <?php if (isset($_SESSION['username'])) : ?>
                                                    <div class="card-tools">
                                                        <a href="#addimmunization" data-toggle="modal" class="btn btn-info btn-sm">
                                                            <i class="fa fa-plus"></i>&nbsp
                                                            Add
                                                        </a>
                                                        <!-- <a type="button" href="generate_officials.php" class="btn btn-sm btn-secondary" title="Print">
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
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <?php if (!empty($immunizationDetails)) : ?>
                                                        <thead>
                                                            <tr>
                                                                <th>Tetanus-containing Vaccine</th>
                                                                <th>Date Given</th>
                                                                <th>When to return</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($immunizationDetails as $index => $row) : ?>
                                                                <?php $selectId = "select_" . $index; ?>
                                                                <tr>
                                                                    <td><?= $row['tetanus_containing_vaccine_detail'] ?></td>
                                                                    <td><?= date("F j, Y", strtotime($row['date_given'])) ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($row['when_to_return'] === '0000-00-00') {
                                                                            echo " ";
                                                                        } else {
                                                                            echo date("F j, Y", strtotime($row['when_to_return']));
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a type="button" href="#editimmunization<?= $row['id_immunization_record'] ?>" data-toggle="modal" class="btn btn-link btn-primary" title="Edit">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <?php include 'p_edit_immunization_record.php'; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                        <?php else : ?>
                                                            <p class="text-center">No record to show</p>
                                                        <?php endif ?>
                                                        </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Trimester Cards -->
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Trimesters</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center mb-4" id="pills-tab-with-icon" role="tablist">
                                                <li class="nav-item submenu">
                                                    <a class="nav-link active show" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                                                        <i class="flaticon-calendar"></i>
                                                        <blockquote class="blockquote text-center">
                                                            <p class="h3 mb-0">Sa Unang Tatlong Buwan (First Trimester)</p>
                                                            <p class="mb-0">Hindi dapat bababa sa isang tsek-up.</p>
                                                        </blockquote>
                                                    </a>
                                                </li>
                                                <li class="nav-item submenu">
                                                    <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                                                        <i class="flaticon-calendar"></i>
                                                        <blockquote class="blockquote text-center">
                                                            <p class="h3 mb-0">Sa Pangalawang Tatlong Buwan (Second Trimester)</p>
                                                            <p class="mb-0">Hindi dapat bababa sa isang tsek-up.</p>
                                                        </blockquote>
                                                    </a>
                                                </li>
                                                <li class="nav-item submenu">
                                                    <a class="nav-link" id="pills-contact-tab-icon" data-toggle="pill" href="#pills-contact-icon" role="tab" aria-controls="pills-contact-icon" aria-selected="false">
                                                        <i class="flaticon-calendar"></i>
                                                        <blockquote class="blockquote text-center">
                                                            <p class="h3 mb-0">Sa Huling Tatlong Buwan (Last Trimester)</p>
                                                            <p class="mb-0">Hindi dapat bababa sa dalawang tsek-up.</p>
                                                        </blockquote>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                                                <div class="tab-pane fade active show" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
                                                    <div class="row">
                                                        <!--1st Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Unang check-up">Unang check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($count1Trimester == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>

                                                                                <?php elseif ($count1Trimester == 0) : ?>
                                                                                    <a href="#add1stTrimester" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--2nd Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Ikalawang check-up">Ikalawang check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($count1Trimester == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>
                                                                                <?php elseif ($count1Trimester == 0) : ?>
                                                                                    <a href="#add1stTrimester" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--3rd Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Ikatlong check-up">Ikatlong check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($resulthcpc == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>
                                                                                    <?php include 'p_edit_hcpc.php'; ?>
                                                                                <?php elseif ($resulthcpc == 0) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
                                                    <div class="row">
                                                        <!--4th Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Unang check-up">Unang check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($resulthcpc == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>
                                                                                    <?php include 'p_edit_hcpc.php'; ?>
                                                                                <?php elseif ($resulthcpc == 0) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--5th Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Ikalawang check-up">Ikalawang check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($resulthcpc == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>
                                                                                    <?php include 'p_edit_hcpc.php'; ?>
                                                                                <?php elseif ($resulthcpc == 0) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--6th Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Ikatlong check-up">Ikatlong check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($resulthcpc == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>
                                                                                    <?php include 'p_edit_hcpc.php'; ?>
                                                                                <?php elseif ($resulthcpc == 0) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="pills-contact-icon" role="tabpanel" aria-labelledby="pills-contact-tab-icon">
                                                    <div class="row">

                                                        <!--7th Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Unang check-up">Unang check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($resulthcpc == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>
                                                                                    <?php include 'p_edit_hcpc.php'; ?>
                                                                                <?php elseif ($resulthcpc == 0) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--8th Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Ikalawang check-up">Ikalawang check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($resulthcpc == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>
                                                                                    <?php include 'p_edit_hcpc.php'; ?>
                                                                                <?php elseif ($resulthcpc == 0) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--9th Month (Trimester)-->
                                                        <div class="col-md-4">
                                                            <div class="card full-height">
                                                                <div class="card-header">
                                                                    <div class="card-head-row">
                                                                        <div class="card-title d-inline-block text-truncate"><span title="Ikatlong check-up">Ikatlong check-up</span></div>
                                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                                            <div class="card-tools">
                                                                                <?php if ($resulthcpc == 1) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-edit"></i>&nbsp
                                                                                        Edit
                                                                                    </a>
                                                                                    <?php include 'p_edit_hcpc.php'; ?>
                                                                                <?php elseif ($resulthcpc == 0) : ?>
                                                                                    <a href="" id="activate-fields" data-toggle="modal" class="btn btn-info btn-sm">
                                                                                        <i class="fa fa-plus"></i>&nbsp
                                                                                        Add
                                                                                    </a>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Timbang (weight):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">kg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Taas (height):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text" id="basic-addon3">m</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Age of Gestation:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Blood Pressure:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Nutritional Status:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga payong binigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Laboratory Tests Done:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Urinalysis:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Complete Blood Count (CBC):</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Treatments:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Petsa ng Pagbalik:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Referral sa ospital:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm">
                                                                            <p class="fw-bold">Notes:</p>
                                                                        </div>
                                                                        <div class="col-sm">
                                                                            <textarea class="form-control" id="comment" rows="5"></textarea>
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
                                </div>

                                <!-- Gamutan at Iba pang Serbisyo -->
                                <div class="col-md-12">
                                    <div class="card full-height">
                                        <div class="card-header">
                                            <div class="card-head-row">
                                                <div class="card-title d-inline-block text-truncate"><span title="Kalagayan ng Kalusugan (Nutritional status based on Body Mass Index)">Gamutan at Iba pang Serbisyo</span></div>
                                                <?php if (isset($_SESSION['username'])) : ?>
                                                    <div class="card-tools">
                                                        <a href="#" data-toggle="modal" class="btn btn-info btn-sm">
                                                            <i class="fa fa-plus"></i>&nbsp
                                                            Add
                                                        </a>
                                                        <!-- <a href="#" data-toggle="modal" class="btn btn-info btn-sm">
                                                            <i class="fa fa-plus"></i>&nbsp
                                                            Edit
                                                        </a> -->
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="card-body">

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
                                            <?php foreach ($getRID as $row) : ?>
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

            <!-- Add Children modal 2.0 -->
            <div class="modal fade bd-example-modal-lg" id="addchildreninfo2.0" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                            <?php foreach ($getRID as $row) : ?>
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

            <!-- Add Kasalukuyan at Nakaraang Kondisyon habang nagbubuntis modal -->
            <div class="modal fade bd-example-modal-lg" id="addhcpc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="bodyadd">
                            <form method="POST" action="" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                                <label>Nanay, sagutin ang mga sumusunod sa tulong ng iyong doktor, nars, o midwife.</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Petsa ng unang check-up: </label>
                                            <input type="date" class="form-control" name="first_check_up_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Edad (Age): </label>
                                            <?php
                                            $bdate = $mother_profile['birthdate'];
                                            $dob = new DateTime($bdate);
                                            $now = new DateTime();
                                            $diff = $now->diff($dob);
                                            ?>
                                            <input type="text" class="form-control" value="<?= $diff->y . ' ' . 'years old' ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Timbang (Weight):</label>
                                            <!-- <input type="text" class="form-control" name="p_weight"> -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="p_weight" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2" name="p_weight">kg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Taas (Height): </label>
                                            <!-- <input type="text" class="form-control" name="p_height"> -->
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="p_height" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon3">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-inline-block text-truncate" style="max-width: 100%;" title="Kalagayan ng Kalusugan (Nutritional status based on Body Mass Index)">Kalagayan ng Kalusugan (Nutritional status based on Body Mass Index): </label>
                                            <input type="text" class="form-control" name="health_condition" placeholder="BMI" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-inline-block text-truncate" style="max-width: 100%;">Petsa ng huling regla (Date of last menstrual period): </label>
                                            <input type="date" class="form-control" name="last_mens_period_date" id="last_mens_period" onchange="calculateExpectedDeliveryDate()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="d-inline-block text-truncate" style="max-width: 100%;">Kailan ako manganganak (Expected date of delivery): </label>
                                            <input type="date" class="form-control" name="expected_date_delivery" id="expected_date_delivery">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="d-inline-block text-truncate" style="max-width: 100%;">No. of Pregnancy</label>
                                            <input type="number" class="form-control" name="<?= $count_child + 1 ?>"> <!-- The output for this will be based on her children and for being pregnant now. -->
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <div class="modal-footer">
                                <input type="hidden" value="<?= $id ?>" name="mother_id">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Immunization Record modal -->
            <div class="modal fade bd-example-modal-lg" id="addimmunization" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Immunization Record</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="bodyaddimmunization">
                            <form method="POST" action="model/save_immunization_record.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                                <div id="inputContainer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tetanus-containing Vaccine </label>
                                                <select class="form-control js-states" style="width:100%;" id="tetanus_containing_vaccine" name="tcv" required>
                                                    <?php foreach ($getTV as $row) : ?>
                                                        <option value=""></option>
                                                        <option value="<?= $row['tetanus_containing_vaccine'] ?>"><?= $row['tetanus_containing_vaccine_detail'] ?> </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Given </label>
                                                <input type="date" class="form-control" name="date_given" id="date_given" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>When to Return </label>
                                                <input type="date" class="form-control" name="when_to_return" id="when_to_return">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <div class=" modal-footer">
                                <input type="hidden" value="<?= $id ?>" name="mother_id">
                                <input type="hidden" value="<?= $hcpc_id ?>" name="hcpc_id">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 1st Month Trimester Add Modal -->
            <div class="modal fade bd-example-modal-lg" id="add1stTrimester" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="bodyadd">
                            <form method="POST" action="model/save_hcpc.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                                <input type="text" name="month" value="1">
                                <input type="text" name="hcpc_id" value="<?= $hcpc_id ?>">
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Petsa</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" name="" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Timbang (weight):</p>
                                    </div>
                                    <div class="col-sm">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon3">kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Taas (height):</p>
                                    </div>
                                    <div class="col-sm">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon3">m</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Age of Gestation:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Blood Pressure:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Nutritional Status:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Pagsusuri ng kalagayan ng buntis:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Mga payong binigay:</p>
                                    </div>
                                    <div class="col-sm">
                                        <textarea class="form-control" id="comment" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Mga pagbabago sa Birth Plan:</p>
                                    </div>
                                    <div class="col-sm">
                                        <textarea class="form-control" id="comment" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Pagsusuri ng Ngipin:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Laboratory Tests Done:</p>
                                    </div>
                                    <div class="col-sm">
                                        <textarea class="form-control" id="comment" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Urinalysis:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Complete Blood Count (CBC):</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Etiologic tests para sa STIs, kung kinakailangan:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Pap Smear, kung kinakailangan:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Gestational diabetes (oral glucose challenge test), kung kinakailangan:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Bacteriuria, kung kinakailangan:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Treatments:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Pinag-usapan/Serbisyong ibinigay:</p>
                                    </div>
                                    <div class="col-sm">
                                        <textarea class="form-control" id="comment" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Petsa ng Pagbalik:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Pangalan ng Health Service Provider:</p>
                                    </div>
                                    <div class="col-sm">
                                        <textarea class="form-control" id="comment" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Referral sa ospital:</p>
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm">
                                        <p class="fw-bold">Notes:</p>
                                    </div>
                                    <div class="col-sm">
                                        <textarea class="form-control" id="comment" rows="5"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <div class="modal-footer">
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
    <script src="assets/js/plgin/datatables/datatables.min.js"></script>
    <script src="assets/js/plugin/moment/moment.min.js"></script>
    <script src="assets/js/plugin/dataTables.dateTime.min.js"></script>
    <script src="assets/js/plugin/datatables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/plugin/datatables/Buttons-1.6.1/js/buttons.print.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        function calculateExpectedDeliveryDate() {
            var initialDate = document.getElementById("last_mens_period").value;
            var dueDate = new Date(initialDate);
            dueDate.setDate(dueDate.getDate() + (40 * 7)); // add 40 weeks

            // format due date as yyyy-mm-dd
            var formattedDueDate = dueDate.getFullYear() + '-' + ('0' + (dueDate.getMonth() + 1)).slice(-2) + '-' + ('0' + dueDate.getDate()).slice(-2);

            // set the due date as the value of the other input field
            document.getElementById("expected_date_delivery").value = formattedDueDate;
        }

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

        $("#tetanus_containing_vaccine").select2({
            theme: "bootstrap4",
            placeholder: "-Select-",
            allowClear: true,
            dropdownParent: $('#bodyaddimmunization')
        });

        $(".immunizationSelect").select2({
            theme: "bootstrap4",
            placeholder: "-Select-",
            allowClear: true
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
        // $(document).ready(function() {
        //     // Add Field button click event
        //     $('#addField').click(function() {
        //         $('#inputContainer').append('');
        //     });

        //     // Remove Field button click event
        //     $(document).on('click', '.removeField', function() {
        //         $(this).closest('.inputRow').remove();
        //     });

        // Form submission event
        // $('#myForm').submit(function(e) {
        //     e.preventDefault();
        //     var formData = $(this).serialize();
        //     console.log(formData); // You can perform an AJAX request or submit the form data to the server using this variable
        // });
        // });
    </script>
</body>

</html>