<?php include 'server/server.php' ?>
<?php

$query = "SELECT * FROM tblresident2";
$result = $conn->query($query);
$resident = array();
while ($row = $result->fetch_assoc()) {
    $resident[] = $row;
}

// $query = "SELECT *, tblresident.id as id, tblpurok.id as purok_id, tbl_org.id as org_id, tbl_users.id as user_id FROM tblresident JOIN tblpurok ON tblpurok.id=tblresident.purok JOIN tbl_org ON tbl_org.id=tblresident.organization JOIN tbl_users ON tbl_users.id=tblresident.username";
// $result = $conn->query($query);
// $resident = array();
// while($row = $result->fetch_assoc()){
//     $resident[] = $row; 
// }

$query1 = "SELECT * FROM tblpurok ORDER BY `purok_name`";
$result1 = $conn->query($query1);
$purok = array();
while ($row = $result1->fetch_assoc()) {
    $purok[] = $row;
}

$query3 = "SELECT * FROM tbl_org ORDER BY `org_name`";
$result3 = $conn->query($query3);
$org = array();
while ($row = $result3->fetch_assoc()) {
    $org[] = $row;
}

$query4 = "SELECT * FROM tbl_household ORDER BY household_number ASC";
$result4 = $conn->query($query4);
$hosuehold = array();
while ($row = $result4->fetch_assoc()) {
    $household[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <?php include 'model/fetch_brgy_info.php' ?>
    <title>Resident Information - Barangay Management System</title>

    <script defer src="validScript.js"></script>

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
                                <h2 class="text-white fw-bold">Residents</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">

                            <?php if (isset($_SESSION['message'])) : ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Resident Information</div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                            <div class="card-tools">
                                                <!-- <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm"> -->
                                                <!-- <a href="#add" data-toggle="modal" class="btn btn-info btn-sm"> -->
                                                <a href="residentAddForm1.php" class="btn btn-info btn-sm">
                                                    <i class="fa fa-plus" style="color:white;"></i>&nbsp
                                                    Resident
                                                </a>
                                                <!-- <a href="model/export_resident_csv.php" class="btn btn-danger btn-border btn-round btn-sm"> -->
                                                <!-- <a href="model/export_resident_csv.php" class="btn btn-danger btn-sm">
												<i class="fa fa-file"></i>&nbsp
												Export CSV
											</a> -->
                                                <button class="btn btn-secondary btn-sm" onclick="location.href='generate_resident_info2.php?state=all'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="residenttable" class="display table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Picture</th>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Civil Status</th>
                                                    <th scope="col">Sex</th>
                                                    <th scope="col">Household #</th>
                                                    <th scope="col">Organization</th>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                        <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                            <th scope="col">PWD</th>
                                                            <th scope="col">Updated at</th>
                                                            <th scope="col">User</th>
                                                            <th scope="col">Action</th>
                                                        <?php elseif ($_SESSION['role'] == 'staff') : ?>
                                                            <th scope="col">PWD</th>
                                                            <th scope="col">Updated at</th>
                                                            <th scope="col">User</th>
                                                            <th scope="col">Action</th>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($resident)) : ?>
                                                    <?php $no = 1;
                                                    foreach ($resident as $row) : ?>
                                                        <tr>
                                                            <td>
                                                                <div class="avatar avatar-xs">
                                                                    <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?= ucwords($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ($row['ext'] === '' ? '' : ', ' . $row['ext'])) ?>
                                                            </td>
                                                            <td><?= $row['birthdate'] ?></td>
                                                            <?php

                                                            //Calculation 1
                                                            /* $bday = new DateTime($row['birthdate']); // Your date of birth
                                                            $today = new Datetime(date('y.m.d'));
                                                            $diff = $bday->diff($today);

                                                            //Calculation for Age
                                                            $final_age = $diff->y;*/

                                                            //Calculation 2
                                                            $DateOfBirth = $row['birthdate'];

                                                            $dob = new DateTime($DateOfBirth);
                                                            $now = new DateTime();
                                                            $diff = $now->diff($dob);

                                                            ?>
                                                            <td><?php echo $diff->y; ?></td>
                                                            <td><?= ucwords($row['civilstatus']) ?></td>
                                                            <td><?= $row['sex'] ?></td>
                                                            <td>
                                                                <?php
                                                                $houseHNum = $row['id_household'];
                                                                $queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$houseHNum'";
                                                                $resultHouseholdNumber = $conn->query($queryHouseholdNumber);
                                                                $houseHoldNumber = $resultHouseholdNumber->fetch_assoc();

                                                                echo $houseHoldNumber['household_number'] . ' ' . '<i>' . ucwords($houseHoldNumber['household_type']) . '</i>';
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $org = $row['id_org'];

                                                                if ($org == 'none') {
                                                                    echo "None";
                                                                } else {

                                                                    $queryOrg = "SELECT * FROM tbl_org WHERE id_org='$org'";
                                                                    $resultOrg = $conn->query($queryOrg);
                                                                    $org_Name = $resultOrg->fetch_assoc();
                                                                    echo $org_Name['org_name'];
                                                                }
                                                                ?>
                                                            </td>
                                                            <?php if (isset($_SESSION['username'])) : ?>
                                                                <?php if ($_SESSION['role'] == 'administrator' || $_SESSION['role'] == 'staff') : ?>
                                                                    <td><?= $row['pwd'] ?></td>
                                                                    <td><?= $row['res_updated_at'] ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $user_name = $row['id_user'];

                                                                        $queryUser = "SELECT * FROM tbl_users WHERE id_user='$user_name'";
                                                                        $resultUser = $conn->query($queryUser);
                                                                        $user = $resultUser->fetch_assoc();

                                                                        echo $user['user_username'];

                                                                        ?>
                                                                    </td>
                                                                <?php elseif ($_SESSION['role'] == 'staff') : ?>
                                                                    <td><?= $row['pwd'] ?></td>
                                                                    <td><?= $row['res_updated_at'] ?></td>
                                                                    <td><?= $row['username'] ?></td>
                                                                <?php endif ?>
                                                                <td>
                                                                    <div class="form-button-action">
                                                                        <!-- <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Resident" 
                                                                    onclick="editResident(this)"

                                                                    data-id="<?= $row['id'] ?>" 
                                                                    data-national="<?= $row['national_id'] ?>"
                                                                    data-region="<?= $row['region'] ?>"
                                                                    data-city="<?= $row['city'] ?>" 
                                                                    data-province="<?= $row['province'] ?>"
                                                                    data-barangay="<?= $row['barangay'] ?>"
                                                                    data-fname="<?= $row['firstname'] ?>" 
                                                                    data-mname="<?= $row['middlename'] ?>" 
                                                                    data-lname="<?= $row['lastname'] ?>"
                                                                    data-ext="<?= $row['ext'] ?>"
                                                                    data-alias="<?= $row['alias'] ?>" 
                                                                    data-bplace="<?= $row['birthplace'] ?>" 
                                                                    data-bdate="<?= $row['birthdate'] ?>" 
                                                                    data-age="<?= $row['age'] ?>"
                                                                    data-cstatus="<?= $row['civilstatus'] ?>" 
                                                                    data-sex="<?= $row['sex'] ?>"
                                                                    data-purok="<?= $row['purok_id'] ?>" 
                                                                    data-residence_type="<?= $row['residence_type'] ?>"
                                                                    data-residence_remarks="<?= $row['residence_remarks'] ?>"
                                                                    data-vstatus="<?= $row['voterstatus'] ?>"
                                                                    data-indetity="<?= $row['identified_as'] ?>" 
                                                                    data-organization="<?= $row['org_id'] ?>"
                                                                    data-pwd="<?= $row['pwd'] ?>"
                                                                    data-indigent="<?= $row['indigent'] ?>"
                                                                    data-number="<?= $row['phone'] ?>" 
                                                                    data-email="<?= $row['email'] ?>" 
                                                                    data-address="<?= $row['address'] ?>" 
                                                                    data-img="<?= $row['picture'] ?>" 
                                                                    data-citi="<?= $row['citizenship']; ?>" 
                                                                    data-occu="<?= $row['occupation'] ?>"
                                                                    data-hnum="<?= $row['h_num'] ?>"
                                                                    data-housenum="<?= $row['housenum'] ?>"
                                                                    data-streetname="<?= $row['streetname'] ?>" 
                                                                    data-dead="<?= $row['resident_type']; ?>" 
                                                                    data-remarks="<?= $row['remarks'] ?>"
                                                                    data-user_id="<?= $_SESSION['id'] ?>">
                                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php else : ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a> -->
                                                                        <a type="button" href="residentEditForm1.1.php?res_id=<?= $row['id_resident'] ?>" class="btn btn-link btn-primary" title="Edit Resident">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>

                                                                        <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator' || isset($_SESSION['username']) && $_SESSION['role'] == 'staff') : ?>
                                                                            <a type="button" href="generate_resident2.php?id=<?= $row['id_resident'] ?>" class="btn btn-link btn-info" title="View Resident">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>
                                                                            <!-- <a type="button" data-toggle="tooltip" href="model/remove_resident.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this resident?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a> -->
                                                                        <?php endif ?>
                                                                    </div>
                                                                </td>
                                                            <?php endif ?>

                                                        </tr>
                                                    <?php $no++;
                                                    endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col">Picture</th>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Civil Status</th>
                                                    <th scope="col">Sex</th>
                                                    <th scope="col">Household #</th>
                                                    <th scope="col">Organization</th>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                        <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                            <th scope="col">PWD</th>
                                                            <th scope="col">Updated at</th>
                                                            <th scope="col">User</th>
                                                            <th scope="col">Action</th>
                                                        <?php elseif ($_SESSION['role'] == 'staff') : ?>
                                                            <th scope="col">PWD</th>
                                                            <th scope="col">Updated at</th>
                                                            <th scope="col">User</th>
                                                            <th scope="col">Action</th>
                                                        <?php endif ?>
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

            <!-- EDIT Resident Modal -->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit/View Resident Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_resident.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                <div class="row">
                                    <div class="col-md-4">

                                        <!-- FOR CAMERA and IMAGE -->
                                        <div id="my_camera1" style="width: 370px; height: 250;" class="text-center">
                                            <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" id="image">
                                        </div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                            <div class="form-group d-flex justify-content-center">
                                                <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam1">Open Camera</button>
                                                <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo1()">Capture</button>
                                            </div>
                                            <div id="profileImage1">
                                                <input type="hidden" name="profileimg">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="img" accept="image/*">
                                            </div>
                                        <?php endif ?>
                                        <div class="form-group">
                                            <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="deceased" value="1" class="selectgroup-input" checked="" id="alive">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-walking"></i></span>
                                                </label>
                                                <p class="mt-1 mr-3"><b>Alive</b></p>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="deceased" value="0" class="selectgroup-input" id="dead">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-people-carry"></i></span>
                                                </label>
                                                <p class="mt-1 mr-3"><b>Deceased</b></p>
                                            </div>
                                        </div>

                                        <!--Intro-->
                                        <div class="form-group">
                                            <label>National ID No.</label>
                                            <input type="text" class="form-control" name="national" id="nat_id" placeholder="Enter National ID No." oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>

                                        <!--NEW-->
                                        <div class="form-group">
                                            <label>Region<span class="text-danger"><b> *</b></span></label>
                                            <input type="text" class="form-control" name="region" id="region" placeholder="Enter Region" required>
                                        </div>
                                        <div class="form-group">
                                            <label>City/Municipal<span class="text-danger"><b> *</b></span></label>
                                            <input type="text" class="form-control" name="city" id="city" placeholder="Enter City/Municipal" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Province<span class="text-danger"><b> *</b></span></label>
                                            <input type="text" class="form-control" name="province" id="province" placeholder="Enter Province" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Barangay<span class="text-danger"><b> *</b></span></label>
                                            <input type="text" class="form-control" name="barangay" id="barangay" placeholder="Enter Barangay" required>
                                        </div>
                                    </div>

                                    <!--Personal Information-->
                                    <div class="col-md-8">
                                        <label><b>I. </b>PERSONAL INFORMATION</label>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Firstname<span class="text-danger"><b> *</b></span></label>
                                                    <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" id="fname" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Middlename</label>
                                                    <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" id="mname" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Lastname<span class="text-danger"><b> *</b></span></label>
                                                    <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" id="lname" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Extension Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Extension" name="ext" id="ext">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Alias</label>
                                                    <input type="text" class="form-control" placeholder="Enter Alias" id="alias" name="alias" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Birthdate<span class="text-danger"><b> *</b></span></label>
                                                    <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" id="bdate" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Place of Birth<span class="text-danger"><b> *</b></span></label>
                                                    <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" id="bplace" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" name="age" id="age" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Sex<span class="text-danger"><b> *</b></span></label>
                                                    <select class="form-control" required name="sex" id="sex">
                                                        <option disabled selected value="">Select Sex</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Civil Status<span class="text-danger"><b> *</b></span></label>
                                                    <select class="form-control" required name="cstatus" id="cstatus">
                                                        <option disabled selected>Select Civil Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widow">Widow</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Citizenship<span class="text-danger"><b> *</b></span></label>
                                                    <input type="text" class="form-control" name="citizenship" id="citizenship" placeholder="Enter citizenship" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Profession/Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occupation">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <label>RESIDENCE ADDRESS</label>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>House No.</label>
                                                    <input type="number" class="form-control" placeholder="House no." name="h_num" id="h_num">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Household Number</label>
                                                    <select class="form-control" name="housenum" id="housenum">
                                                        <option disabled selected>Choose...</option>
                                                        <?php foreach ($household as $row) : ?>
                                                            <option value="<?= ucwords($row['household_number']) ?>"><?= $row['household_number'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <small id="housenumHelp" class="form-text text-muted text-danger"><b>Note: </b>Must update once available</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Street Name<span class="text-danger"><b> *</b></span></label>
                                                    <input type="text" class="form-control" placeholder="Enter Street Name" name="streetname" id="streetname">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Subdivision Name, Apartment, Suite, etc.</label>
                                            <textarea class="form-control" name="address" id="address" placeholder="Enter Subdivision Name..."></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Zone/Sitio/Purok</label>
                                                    <select class="form-control" required name="purok" id="purok">
                                                        <option disabled selected>Choose...</option>
                                                        <?php foreach ($purok as $row) : ?>
                                                            <option value="<?= ucwords($row['id']) ?>"><?= $row['purok_name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Residence Type</label>
                                                    <select class="form-control" required name="residence_type" id="residence_type">
                                                        <option disabled selected>Choose...</option>
                                                        <option value="Permanent">Permanent</option>
                                                        <option value="Temporary">Temporary</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Remarks (Residence)</label>
                                            <textarea class="form-control" name="residence_remarks" id="residence_remarks" required placeholder="Enter remarks here..."></textarea>
                                            <small id="residencte_remarksHelp" class="form-text text-muted"><b>E.g., </b>House ownership, Boarder, Tenant</small>
                                        </div>

                                        <hr>

                                        <label><b>II. </b>OTHER INFORMATIONS</label>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control" placeholder="Enter Contact Number" name="number" id="number">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Voters Status</label>
                                                    <select class="form-control vstatus" required name="vstatus" id="vstatus">
                                                        <option disabled selected>Select Voters Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Identified As</label>
                                                    <select class="form-control indetity" disabled name="indetity" id="indetity">
                                                        <option disabled selected>Select Identity</option>
                                                        <option value="Positive">Positive</option>
                                                        <option value="Negative">Negative</option>
                                                        <option value="Unidentified">Unidentified</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class='form-group'>
                                                    <label>Association/Organization<span class="text-danger"><b> *</b></span></label>
                                                    <select class="form-control" name="organization" id="organization" required>
                                                        <option disabled selected>Select Organization</option>
                                                        <?php foreach ($org as $row) : ?>
                                                            <option value="<?= ucwords($row['id']) ?>"><?= $row['org_name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>PWD</label>
                                                    <select class="form-control" required name="pwd" id="pwd">
                                                        <option disabled selected>Choose...</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Indigent<span class="text-danger"><b> *</b></span></label>
                                                    <select class="form-control" name="indigent" id="indigent" required>
                                                        <option disabled selected>Choose...</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Other Remarks</label>
                                            <textarea class="form-control" name="remarks" placeholder="Enter remarks" id="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="res_id">
                            <input type="hidden" name="user_id" id="user_id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <?php if (isset($_SESSION['username'])) : ?>
                                <button type="submit" class="btn btn-primary">Update</button>
                            <?php endif ?>
                        </div>
                        </form>
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
    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });

        function getAge() {
            var bdate = document.getElementById('date').value;
            bdate = new Date(bdate);
            var today = new Date();
            var age = Math.floor((today - bdate) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('age').value = age;
        }
    </script>
</body>

</html>