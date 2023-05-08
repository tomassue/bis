<?php include 'server/server.php' ?>
<?php

$id = $_GET['id'];

$query = "SELECT * FROM tblresident2 WHERE id_resident='$id'";
$result = $conn->query($query);
$resident = $result->fetch_assoc();

$query2 = "SELECT * FROM tbl_p_fam_members WHERE id_resident='$id'";
$result2 = $conn->query($query2);
$mother_profile = $result2->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Generate Resident Profile - Barangay Management System</title>
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
                                <h2 class="text-white fw-bold">Generate Resident Profile</h2>
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
                                        <div class="card-title">Resident Profile</div>
                                        <div class="card-tools">
                                            <button class="btn btn-info btn-sm" onclick="printDiv('printThis')">
                                                <i class="fa fa-print"></i>
                                                Print Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body m-5" id="printThis">
                                    <div class="d-flex flex-wrap justify-content-center" style="border-bottom:1px solid red">
                                        <div class="text-center">
                                            <h3 class="mb-0">Republic of the Philippines</h3>
                                            <h3 class="mb-0">Province of <?= ucwords($province) ?></h3>
                                            <h3 class="mb-0"><?= ucwords($town) ?></h3>
                                            <h1 class="fw-bold mb-0"><?= ucwords($brgy) ?></i></h1>
                                            <p><i>Mobile No. <?= $number ?></i></p>
                                            <h1 class="fw-bold mb-3">Resident Profile</h2>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="text-center p-1" style="border:1px solid red">
                                                <img src="<?= preg_match('/data:image/i', $resident['picture']) ? $resident['picture'] : 'assets/uploads/resident_profile/' . $resident['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Region:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['region'] ?>">
                                                    </div>

                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Province:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['province'] ?>">
                                                    </div>

                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">National ID:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['national_id'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">City/Municipal:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['city'] ?>">
                                                    </div>

                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Barangay:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['barangay'] ?>">
                                                    </div>

                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Status:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['resident_type'] == 1 ? 'Alive' : 'Deceased' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <hr>
                                    <h3 class="fw mb-3"><b>I.</b> PERSONAL INFORMATION</h2>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?>">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Alias:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['alias'] ?>">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Ext.:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['ext'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthdate:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($resident['birthdate'])) ?>">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthplace:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['birthplace'] ?>">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Age:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <?php
                                                    $bday = new DateTime($resident['birthdate']); // Your date of birth
                                                    $today = new Datetime(date('y.m.d'));
                                                    $diff = $bday->diff($today);

                                                    //Calculation for Age
                                                    $final_age = $diff->y;
                                                    ?>
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $final_age; ?> yrs. old">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Sex:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['sex'] ?>">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Civil Status:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($resident['civilstatus']) ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Citizenship:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['citizenship'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Occupation:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                    <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords(trim($resident['occupation'])) ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <hr>

                                        <h3 class="fw mb-3"><b>II.</b> RESIDENCE ADDRESS</h2>

                                            <?php
                                            $h_id = $resident['id_household'];
                                            $queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$h_id'";
                                            $resultHouseholdNumber = $conn->query($queryHouseholdNumber);
                                            $householdnum = $resultHouseholdNumber->fetch_assoc();
                                            ?>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">House No.:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $householdnum['house_no'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Household No.:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $householdnum['household_number'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Street Name:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $householdnum['household_street_name'] ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">House Type:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($householdnum['household_type']) ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Subdivision Name/Apartment/Suite, etc.</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <textarea class="form-control fw-bold" style="font-size:20px" rows="3"><?= ucwords(trim($householdnum['household_address'])) ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Purok/Zone:</h3>
                                                    </div>
                                                    <?php
                                                    $p_name = $householdnum['id_purok'];
                                                    $queryPurokName = "SELECT * FROM tblpurok WHERE id_purok='$p_name'";
                                                    $resultPurokName = $conn->query($queryPurokName);
                                                    $pName = $resultPurokName->fetch_assoc();
                                                    ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $pName['purok_name'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Residence Type:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($resident['residence_type']) ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Family Head:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <?php if (empty($resident['family_head'])) : ?>
                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="No">
                                                        <?php else : ?>
                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($resident['family_head']) ?>">
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Date of Residence:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($resident['date_of_residence']) ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <hr>

                                            <h3 class="fw mb-3"><b>III. </b>OTHER INFORMATION</h2>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Email Address:</h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['email'] ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Phone number:</h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['phone'] ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Voters Status:</h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['vstatus'] ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Identified as:</h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?php if (empty($resident['identified_as'])) {
                                                                                                                                                echo "N/A";
                                                                                                                                            } else {
                                                                                                                                                echo $resident['identified_as'];
                                                                                                                                            } ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <h3 class="mt-5 col-lg-5 col-md-4 col-sm-4 mt-sm-2 text-left">Association/Organization: </h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                            <?php
                                                            $org = $resident['id_org'];
                                                            $queryOrg = "SELECT * FROM tbl_org WHERE id_org='$org'";
                                                            $resultOrg = $conn->query($queryOrg);
                                                            $org_Name = $resultOrg->fetch_assoc();
                                                            ?>
                                                            <?php if ($resident['id_org'] == 'none') : ?>
                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($resident['id_org']) ?>">
                                                            <?php else : ?>
                                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($org_Name['org_name']) ?>">
                                                            <?php endif ?>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">PWD: </h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['pwd'] ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Indigent: </h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['indigent'] ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Remarks:</h3>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                            <textarea class="form-control fw-bold" style="font-size:20px" rows="3"><?= ucwords(trim($resident['remarks'])) ?></textarea>
                                                        </div>
                                                    </div>
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
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>