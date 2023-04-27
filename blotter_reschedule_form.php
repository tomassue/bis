<?php include 'server/server.php' ?>

<?php if ($_SESSION['role'] == 'administrator') : ?>
    <?php
    $id = $_GET['id'];
    $query = "SELECT * FROM tblblotter JOIN tblblotter_schedule ON tblblotter_schedule.id_blotter=tblblotter.id_blotter JOIN tbl_users ON tbl_users.id_user=tblblotter.id_user WHERE tblblotter_schedule.id_blotter='$id' ORDER BY tblblotter_schedule.id_blotter_schedule DESC LIMIT 1";
    $result = $conn->query($query);
    $blotter = $result->fetch_assoc();

    $query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position NOT IN ('SK Chairrman','Secretary','Treasurer')
                AND `status`='Active' ORDER BY `order` ASC";
    $result1 = $conn->query($query1);
    $officials = array();
    while ($row = $result1->fetch_assoc()) {
        $officials[] = $row;
    }

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Captain' || tblposition.position='Barangay Chairman'";
    $captain = $conn->query($c)->fetch_assoc();
    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Barangay Secretary'";
    $sec = $conn->query($s)->fetch_assoc();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'templates/header.php' ?>
        <title>Blotter/Incident Complaint (RESCHEDULE) - Barangay Management System</title>
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
                                    <h2 class="text-white fw-bold">Reschedule blotter</h2>
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

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card full-height">
                                            <div class="card-header">
                                                <div class="card-title">Blotter Reschedule Form</div>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="model/save_blotter_reschedule.php">
                                                    <div class="form-group">
                                                        <label for="reschedName">Select Date</label><span class="text-danger"><b> *</b></span>
                                                        <input type="date" class="form-control" id="reschedule_blotter_date" name="reschedule_blotter_date" value="<?= $blotter['blotter_date'] ?>" required>
                                                        <small id="reschedHelp" class="form-text text-muted">Select prefered date for the remediation.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reschedName">Select Time</label><span class="text-danger"><b> *</b></span>
                                                        <input type="time" class="form-control" id="reschedule_blotter_time" name="reschedule_blotter_time" value="<?= $blotter['blotter_time'] ?>" required>
                                                        <small id="reschedHelp" class="form-text text-muted">Select prefered time for the remediation.</small>
                                                    </div>
                                                    <input type="hidden" value="<?= $blotter['id_blotter'] ?>" name="id_blotter">
                                            </div>
                                            <div class="card-action">
                                                <button class="btn btn-md btn-success">Submit</button>
                                                </form>
                                                <button class="btn btn-md btn-danger" onclick="window.location.href='blotter.php'">Go Back</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card full-height">
                                            <div class="card-header">
                                                <div class="card-title">Reschedule History</div>
                                            </div>
                                            <div class="card-body">
                                                <!-- <ol class="activity-feed">
                                                    <li class="feed-item feed-item-secondary">
                                                        <time class="date" datetime="9-25">Sep 25</time>
                                                        <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                                                    </li>
                                                    <li class="feed-item feed-item-success">
                                                        <time class="date" datetime="9-24">Sep 24</time>
                                                        <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                                                    </li>
                                                    <li class="feed-item feed-item-info">
                                                        <time class="date" datetime="9-23">Sep 23</time>
                                                        <span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
                                                    </li>
                                                    <li class="feed-item feed-item-warning">
                                                        <time class="date" datetime="9-21">Sep 21</time>
                                                        <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                                                    </li>
                                                    <li class="feed-item feed-item-danger">
                                                        <time class="date" datetime="9-18">Sep 18</time>
                                                        <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                                                    </li>
                                                    <li class="feed-item">
                                                        <time class="date" datetime="9-17">Sep 17</time>
                                                        <span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
                                                    </li>
                                                </ol> -->
                                                <ol class="activity-feed">
                                                    <?php
                                                    //We will get the schedule history of the id using the id_blotter.
                                                    // $queryBlotterScheduleHistory = "SELECT * FROM tblblotter_reschedule WHERE `id_blotter` = '$id'";
                                                    // $resultBlotterScheduleHistory = $conn->query($queryBlotterScheduleHistory);

                                                    $id_blotter = $blotter['id_blotter'];
                                                    $queryBlotterSched = "SELECT * FROM tblblotter_schedule_archive WHERE `id_blotter` = '$id_blotter'";
                                                    $resultBlotterSched = $conn->query($queryBlotterSched);

                                                    $schedHistory = array();
                                                    while ($row = $resultBlotterSched->fetch_assoc()) {
                                                        $schedHistory[] = $row;
                                                    }
                                                    ?>

                                                    <?php if (!empty($schedHistory)) : ?>
                                                        <?php foreach ($schedHistory as $row) : ?>
                                                            <li class="feed-item feed-item-danger">
                                                                <time class="date"><?= date("M d", strtotime($row['created_at_blotter_schedule'])) ?></time>
                                                                <span class="text">
                                                                    <?= $blotter['user_username'] ?>, set a schedule to
                                                                    <a href="generate_blotter_report.php?id=<?= $id ?>">"<?= date("M d", strtotime($row['archive_blotter_date'])) . ' ' . date("h:i A", strtotime($row['archive_blotter_time'])) ?>"</a>
                                                                </span>
                                                            </li>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--BLOTTER DETAILS-->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Blotter Details</div>
                                            <div class="card-tools">
                                                <!-- you can insert buttons here.  -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="card-body m-5" id="printThis">
                                            <div class="d-flex flex-wrap justify-content-center" style="border-bottom:1px solid black">
                                                <div class="text-center">
                                                    <h3 class="mb-0">Republic of the Philippines</h3>
                                                    <h3 class="mb-0">Province of <?= ucwords($province) ?></h3>
                                                    <h3 class="mb-0"><?= ucwords($town) ?></h3>
                                                    <h1 class="fw-bold mb-0"><?= ucwords($brgy) ?></i></h2>
                                                        <p><i>Mobile No. <?= $number ?></i></p>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-3">
                                                    <div class="text-center p-3" style="border:2px solid black">
                                                        <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="200" />
                                                        <?php if (!empty($officials)) : ?>
                                                            <?php foreach ($officials as $row) : ?>
                                                                <h3 class="mt-3 fw-bold mb-0 text-uppercase"><?= ucwords($row['name']) ?></h3>
                                                                <h5 class="mb-2 text-uppercase">BARANGAY <?= ucwords($row['position']) ?></h5>
                                                            <?php endforeach ?>
                                                        <?php endif ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="text-center">
                                                        <h2 class="mt-4 fw-bold">OFFICE OF THE BARANGAY CAPTAIN</h2>
                                                    </div>
                                                    <div class="text-center">
                                                        <h1 class="mt-4 fw-bold mb-5">BLOTTER REPORT</h1>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Complainant:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black; margin:0 !important">
                                                                    <span class="fw-bold" style="font-size:20px;">
                                                                        <?php if ($blotter['comp_id'] !== 'N/A') : ?>
                                                                            <?php
                                                                            $cname = $blotter['comp_id'];

                                                                            $queryCompResident = "SELECT * FROM tblresident2 WHERE id_resident = '$cname'";
                                                                            $resultCompResident = $conn->query($queryCompResident);
                                                                            $comp = $resultCompResident->fetch_assoc();
                                                                            ?>

                                                                            <?= ucwords($comp['firstname'] . ' ' . $comp['middlename'] . ' ' . $comp['lastname']) ?>
                                                                        <?php elseif ($blotter['comp_id'] == 'N/A') : ?>
                                                                            <?= ucwords($blotter['comp_nameNotResident']) ?>
                                                                        <?php endif ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Complainant's Address:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black; margin:0 !important">
                                                                    <span class="fw-bold" style="font-size:20px;">
                                                                        <?php if ($blotter['comp_id'] !== 'N/A') : ?>
                                                                            <?php
                                                                            $cname = $blotter['comp_id'];
                                                                            $queryCompResident = "SELECT * FROM tblresident2 WHERE id_resident = '$cname'";
                                                                            $resultCompResident = $conn->query($queryCompResident);
                                                                            $comp = $resultCompResident->fetch_assoc();

                                                                            $caddress = $comp['id_household'];
                                                                            $queryCompAddress = "SELECT * FROM tbl_household WHERE id_household = '$caddress'";
                                                                            $resultCompAddress = $conn->query($queryCompAddress);
                                                                            $complainantAddress = $resultCompAddress->fetch_assoc();

                                                                            $cpurok = $complainantAddress['id_purok'];
                                                                            $queryCompPurok = "SELECT * FROM tblpurok WHERE id_purok = '$cpurok'";
                                                                            $resultCompPurok = $conn->query($queryCompPurok);
                                                                            $purokName = $resultCompPurok->fetch_assoc();
                                                                            ?>

                                                                            <?= $purokName['purok_name'] . ', ' . $complainantAddress['household_street_name'] . ', ' . $complainantAddress['household_address'] ?>
                                                                        <?php else : ?>
                                                                            <?= ucwords($blotter['comp_addNotResident']) ?>
                                                                        <?php endif ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Complainant's Contact No.:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black">
                                                                    <?php if ($blotter['comp_id'] !== 'N/A') : ?>
                                                                        <?php
                                                                        $cnum = $blotter['comp_id'];
                                                                        $queryCnumResident = "SELECT * FROM tblresident2 WHERE id_resident = '$cnum'";
                                                                        $resultCnumResident = $conn->query($queryCnumResident);
                                                                        $compCnum = $resultCnumResident->fetch_assoc();
                                                                        ?>

                                                                        <?php if (empty($compCnum['phone'])) : ?>
                                                                            <span class="fw-bold" style="font-size:20px"><?= ucwords('None') ?></span>
                                                                        <?php else : ?>
                                                                            <span class="fw-bold" style="font-size:20px"><?= $compCnum['phone'] ?></span>
                                                                        <?php endif ?>
                                                                    <?php else : ?>
                                                                        <span class="fw-bold" style="font-size:20px"><?= $blotter['comp_cnumNotResident'] ?></span>
                                                                    <?php endif ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Status:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black">
                                                                    <span class="fw-bold" style="font-size:20px"><?= ucwords($blotter['blotter_status']) ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Schedule:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black">
                                                                    <span class="fw-bold" style="font-size:20px">
                                                                        <?= date('F d, Y', strtotime($blotter['blotter_date'])) . '; ' . date('h:i:s A', strtotime($blotter['blotter_time'])) ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Nature of Case:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black">
                                                                    <span class="fw-bold" style="font-size:20px">
                                                                        <?php
                                                                        $nocID = $blotter['noc_id'];
                                                                        $queryNoc = "SELECT * FROM tbl_nature_of_case WHERE noc_id = '$nocID'";
                                                                        $resultNoc = $conn->query($queryNoc);
                                                                        $noc_name = $resultNoc->fetch_assoc();
                                                                        ?>

                                                                        <?php if ($blotter['noc_id'] == 'Others') : ?>
                                                                            <?= $blotter['noc_others'] ?>
                                                                        <?php else : ?>
                                                                            <?= $noc_name['noc_name'] ?>
                                                                        <?php endif ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Respondent:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black">
                                                                    <?php
                                                                    $resp = $blotter['resp_id'];
                                                                    $queryRespondent = "SELECT * FROM tblresident2 WHERE id_resident = '$resp'";
                                                                    $resultRespondent = $conn->query($queryRespondent);
                                                                    $respName = $resultRespondent->fetch_assoc();
                                                                    ?>
                                                                    <span class="fw-bold" style="font-size:20px"><?= ucwords($respName['firstname'] . ' ' . $respName['middlename'] . ' ' . $respName['lastname']) ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Respondent's Address:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black; margin:0 !important">
                                                                    <span class="fw-bold" style="font-size:20px;">
                                                                        <?php
                                                                        $respAdd = $blotter['resp_id'];
                                                                        $queryRespondentAddress = "SELECT * FROM tblresident2 WHERE id_resident = '$respAdd'";
                                                                        $resultRespondentAddress = $conn->query($queryRespondentAddress);
                                                                        $respidhousehold = $resultRespondentAddress->fetch_assoc();

                                                                        $respAddress = $respidhousehold['id_household'];
                                                                        $queryRespAddress = "SELECT * FROM tbl_household WHERE id_household = '$respAddress'";
                                                                        $resultRespAddress = $conn->query($queryRespAddress);
                                                                        $respondentAddress = $resultRespAddress->fetch_assoc();

                                                                        $rPurok = $respondentAddress['id_purok'];
                                                                        $queryRespondentPurok = "SELECT * FROM tblpurok WHERE id_purok = '$rPurok'";
                                                                        $resultRespondentPurok = $conn->query($queryRespondentPurok);
                                                                        $respondentPurok = $resultRespondentPurok->fetch_assoc();
                                                                        ?>

                                                                        <?= ucwords($respondentPurok['purok_name'] . ', ' . $respondentAddress['household_street_name'] . ', ' . $respondentAddress['household_address']) ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Respondent's Contact No.:</h3>
                                                                <div class="col-lg-8 col-md-8 col-sm-8" style="border-bottom:1px solid black">
                                                                    <span class="fw-bold" style="font-size:20px;">
                                                                        <?php
                                                                        $rnum = $blotter['resp_id'];
                                                                        $queryRnumResident = "SELECT * FROM tblresident2 WHERE id_resident = '$rnum'";
                                                                        $resultRnumResident = $conn->query($queryRnumResident);
                                                                        $respCnum = $resultRnumResident->fetch_assoc();
                                                                        ?>

                                                                        <?php if (empty($respCnum['phone'])) : ?>
                                                                            <?= ucwords('None') ?>
                                                                        <?php else : ?>
                                                                            <?= ucwords($respCnum['phone']) ?>
                                                                        <?php endif ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">What happened?</h3>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                <!-- <textarea class="form-control fw-bold" style="font-size:20px;" rows="20"><?= ucwords(trim($blotter['comp_what'])) ?></textarea> -->
                                                                <p class="form-control fw-bold" style="font-size: 20px;"><?= ucwords(trim($blotter['comp_what'])) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group row">
                                                                <h3 class="mt-5 col-lg-8 col-md-8 col-sm-4 mt-sm-2 text-left">What does the complainant want to do with the issue?</h3>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                                <!-- <textarea class="form-control fw-bold" style="font-size:20px;"><?= ucwords(trim($blotter['comp_what2'])) ?></textarea> -->
                                                                <p class="form-control fw-bold" style="font-size: 20px;"><?= ucwords(trim($blotter['comp_what2'])) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pt-5 col-md-12">
                                                    <div class="pt-5 p-3 text-right mr-3">
                                                        <h2 class="fw-bold mb-0 text-uppercase"><?= ucwords($captain['name']) ?></h2>
                                                        <p class="mr-3">PUNONG BARANGAY</p>
                                                    </div>
                                                    <div class="pt-5 p-3 text-left">
                                                        <h2 class="fw-bold mb-0 text-uppercase"><?= empty($sec['name']) ? 'Please Create Official with Secretary Position' : ucwords($sec['name']) ?></h2>
                                                        <p class="ml-2">BARANGAY SECRETARY</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex flex-wrap justify-content-end">
                                                    <div class="p-3 text-center">
                                                        <div class="border mb-3" style="height:150px;width:290px">
                                                            <p class="mt-5 mb-0 pt-5">Right Thumb Mark</p>
                                                        </div>
                                                        <h2 class="fw-bold mb-0">
                                                            <?php if ($blotter['comp_id'] !== 'N/A') : ?>
                                                                <?php
                                                                $cname = $blotter['comp_id'];

                                                                $queryCompResident = "SELECT * FROM tblresident2 WHERE id_resident = '$cname'";
                                                                $resultCompResident = $conn->query($queryCompResident);
                                                                $comp = $resultCompResident->fetch_assoc();
                                                                ?>

                                                                <?= ucwords($comp['firstname'] . ' ' . $comp['middlename'] . ' ' . $comp['lastname']) ?>
                                                            <?php elseif ($blotter['comp_id'] == 'N/A') : ?>
                                                                <?= ucwords($blotter['comp_nameNotResident']) ?>
                                                            <?php endif ?></h2>
                                                        <p>Complainant's Signature</p>
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

                <!-- Main Footer -->
                <?php include 'templates/main-footer.php' ?>
                <!-- End Main Footer -->

            </div>

        </div>
        <?php include 'templates/footer.php' ?>
    </body>

    </html>
<?php else : ?>
    <?php header("Location: index.php"); ?>
<?php endif; ?>