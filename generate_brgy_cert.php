<?php include 'server/server.php' ?>

<?php
if (isset($_POST["submit"])) {
    $recipients_name = $_POST['recipients_name'];
    $amount = $_POST['amount'];
    $details = $_POST['details'];
    $purpose = $_POST['purpose'];
    $id = $_POST['id_resident']; //id_resident

    $_SESSION['recipients_name'] = $recipients_name;
    $_SESSION['amount'] = $amount;
    $_SESSION['details'] = $details;
    //$_SESSION['id_resident'] = $id; //id_resident
    $_SESSION['page'] = 'brgy_cert';
?>

    <?php
    // $id = $_GET['id'];
    $query = "SELECT * FROM tblresident2 WHERE id_resident='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();

    $query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position NOT IN ('SK Chairrman')
                AND `status`='Incumbent' ORDER BY `order` ASC";
    $result1 = $conn->query($query1);
    $officials = array();
    while ($row = $result1->fetch_assoc()) {
        $officials[] = $row;
    }

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Captain' OR tblposition.position='Barangay Chairman'";
    $captain = $conn->query($c)->fetch_assoc();

    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Secretary'";
    $sec = $conn->query($s)->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'templates/header.php' ?>
        <title>Barangay Certificate - Barangay Management System</title>
    </head>
    <style type="text/css">
        .border {
            border-right: 1px solid black !important;
        }

        body {
            color: black;
        }

        #cont {
            position: relative;
            top: 0;
            left: 0;
        }

        #head {
            position: relative;
            top: 30px;
            left: 0;
            /*        border: 1px green solid;*/
        }

        #brgylogo {
            position: absolute;
            top: 50px;
            left: 40px;
            /*        border: 1px red solid;*/
        }

        #bg-brgylogo {
            position: absolute;
            top: 300px;
            left: 1px;
            width: 1000px;
            height: 1000px;
            opacity: 0.2;
            /*        border: 1px red solid;*/
        }

        p {
            padding: 0px;
            margin: 0px;
        }

        .vl {
            border-left: 1px solid black;
            height: 100%;
            position: absolute;
            left: 50%;
            margin-left: 130px;
            top: -9px;
        }
    </style>

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
                                    <h2 class="text-white fw-bold">Generate Certificate</h2>
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

                                <div class="alert alert-warning" role="alert">
                                    <b>DON'T REFRESH</b> this page!
                                </div>

                                <div class="card" id="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Barangay Certificate</div>
                                            <div class="card-tools">
                                                <button class="btn btn-info btn-sm" onclick="printDiv('printThis')">
                                                    <i class="fa fa-print"></i>
                                                    Print Certificate
                                                </button>
                                                <a type="button" href="resident_certification.php" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to go back? You will have to repeat the process again from the previous page.')" data-original-title="Go Back">
                                                    <i class="fas fa-file-alt"></i>&nbsp Go Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body bg-brgylogo m-5" id="printThis">
                                        <div class="d-flex flex-wrap justify-content-center" style="border-bottom:1px solid black">
                                            <div class="container">
                                                <div class="row" id="cont">
                                                    <img id="brgylogo" style="width:130px; height: 130px;" src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" />

                                                    <img id="bg-brgylogo" src="assets/uploads/<?= $brgy_logo ?>" />

                                                    <div class="col-12 p-3 text-center" id="head">
                                                        <p class="fw-bold" style="font-size: 20px; font-family: Book Antiqua; line-height: 23px;">Republic of the Philippines<br>City of <?= ucwords($town) ?><br><?= ucwords($brgy) ?><br><br>OFFICE OF THE BARANGAY CHAIRMAN</p>
                                                        <br>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="text-center border border-top-0 border-left-0 border-bottom-0" style="margin-top: -9px;">
                                                    <img style="margin-top: 10px;" src="<?= preg_match('/data:image/i', $resident['picture']) ? $resident['picture'] : 'assets/uploads/resident_profile/' . $resident['picture'] ?>" class="img-fluid" width="200" /><br><br>
                                                    <div class="text-left">
                                                        <h3 class="mt-3 mb-0" style="line-height: 20px; font-family: Book Antiqua;"><span class="fw-bold"><u>Barangay Officials</u></span><br>
                                                            <h5 style="font-family: Georgia;"><?= ucwords($brgy) ?></h5>
                                                        </h3><br>
                                                        <?php if (!empty($officials)) : ?>
                                                            <?php foreach ($officials as $row) : ?>
                                                                <h3 class="mb-0" style="line-height: 20px; font-family: Georgia;"><span class="fw-bold text-uppercase font-italic">
                                                                        <?= $row['honorifics'] ?> <?= ucwords($row['name']) ?></span><br>
                                                                    <h5 style="font-family: Georgia;"><i><?= ucwords($row['position']) ?></i></h5>
                                                                </h3>
                                                                <h5 class="mb-2 text-uppercase">&nbsp</h5>
                                                            <?php endforeach ?>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="text-center">
                                                    <h2 class="mt-4 fw-bold"> </h2>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <div class="text-center">
                                                    <h1 class="mt-4 fw-bold mb-5" style="font-family: Book Antiqua; font-size: 30px;">C E R T I F I C A T I O N</h1>
                                                </div>

                                                <h2 class="mt-5 fw-bold" style="font-family: Book Antiqua;">
                                                    TO WHOM IT MAY CONCERN:
                                                </h2>

                                                <h2 class="mt-3" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                    <span class="fw-bold text-uppercase">This is to certify</span> that <span class="fw-bold" style="font-size:25px"><?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?></span>, of legal age, <span class="text-lowercase"><?= ucwords($resident['civilstatus']) ?></span>, <?= ucwords($resident['citizenship']) ?> Citizen, a resident of
                                                    <span>
                                                        <?php
                                                        $houseHNum = $resident['id_household'];
                                                        $queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$houseHNum'";
                                                        $resultHouseholdNumber = $conn->query($queryHouseholdNumber);
                                                        $houseHoldNumber = $resultHouseholdNumber->fetch_assoc();

                                                        echo $houseHoldNumber['household_address'];
                                                        ?>
                                                        , <?= ucwords($brgy) ?>, <?= ucwords($resident['city']) ?> City</span>, Philippines, is known to me to be of good moral character and a law abiding citizen with no derogatory records whatsoever.
                                                </h2>

                                                <h2 class="mt-3" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                    This certification is issued upon the request of the above named person for <?= $purpose ?> purpose/s and for whatever legal purpose it may serve best.
                                                </h2>

                                                <h2 class="mt-3 mb-5" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                    Issued this <span class="fw-bold" style="font-size:25px"><?= date("jS \of F Y") ?></span>, <?= $brgy ?>, City of <?= $resident['city'] ?>.
                                                </h2>

                                                <br>
                                                <br>
                                                <br>
                                                <br>

                                                <div style="float: right;">
                                                    <h2 style="font-family: Book Antiqua; text-align: center; line-height: 25px;" class="mt-5"><u><span class="fw-bold text-uppercase"><?= ucwords($captain['name']) ?></span></u><br><span style="text-align: center;">Barangay Chairman</span></h2>
                                                    <p class="mr-3"></p>
                                                </div>

                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>

                                                <div style="margin-top: 10%;">
                                                    <h5 style="font-family: Book Antiqua; text-align: left; line-height: 20px;">Issued On<span style="font-family: Book Antiqua; margin-left: 30px;"><u><?= date('Y-m-d') ?></u></span><br>Amount<span style="font-family: Book Antiqua; margin-left: 42px;"><u>P <?= number_format($amount, 2) ?></u></span></h5>
                                                    <p class="mr-3"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Modal -->
                <!-- <div class="modal fade" id="pment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Payment</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="form-group">
                                    <label>Amount<span class="text-danger"><b> *</b></span></label>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter amount to pay" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Issued<span class="text-danger"><b> *</b></span></label>
                                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Payment Details(Optional)</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Barangay Clearance Payment</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Purpose<span class="text-danger"><b> *</b></span></label>
                                    <input type="text" name="purpose" id="purpose" class="form-control" placeholder="Enter purpose" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="name" value="<?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?>">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div> -->

                <!-- Printing Modal -->
                <!-- <div class="modal fade" id="print" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Print Certificate</h5>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="generate_brgy_cert_print.php">
                                    <div class="form-group">
                                        <label>Amount<span class="text-danger"><b> *</b></span></label>
                                        <input type="number" class="form-control" name="amount" value="<?= $amount ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Date Issued<span class="text-danger"><b> *</b></span></label>
                                        <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Payment Details(Optional)</label>
                                        <textarea class="form-control" name="details" value="<?= $details ?>">Barangay Clearance Payment</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Purpose<span class="text-danger"><b> *</b></span></label>
                                        <input type="text" name="purpose" id="purpose" class="form-control" value="<?= $purpose ?>" oninput="this.value = this.value.replace(/[^A-z\s]/g, '').replace(/(\..*)\./g, '$1');" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Name of the resident<span class="text-danger"><b> *</b></span></label>
                                        <input type="text" name="name" value="<?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?>">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="text" name="id" value="<?= $id ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> -->

                <!-- Main Footer -->
                <?php include 'templates/main-footer.php' ?>
                <!-- End Main Footer -->
                <!-- <?php if (!isset($_GET['closeModal'])) { ?>
                <script>
                    setTimeout(function() {
                        openModal();
                    }, 1000);
                </script>
            <?php } ?> -->
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

                // window.location.replace("resident_certification.php");
                window.location.replace("model/save_pment.php");
            }
        </script>
    </body>

    </html>
<?php
}
?>