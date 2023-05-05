<?php include 'server/server.php' ?>

<?php
if (isset($_POST["submit"])) {
    $id = $_POST['id_resident'];
    $recipients_name = $_POST['recipients_name'];
    $details = $_POST['details'];
    $fname_before = $_POST['fname_before'];
    $mname_before = $_POST['mname_before'];
    $lname_before = $_POST['lname_before'];
    $purpose = $_POST['purpose'];

    $_SESSION['recipients_name'] = $recipients_name;
    $_SESSION['details'] = $details;
    //$_SESSION['id_resident'] = $id; //id_resident

    //Those certificates that doesn't require payments, I'll be using this sesssion to determine where the save_transaction.php will be heading after the save_transaction.php is executed.
    $_SESSION['page'] = 'oneness';
?>

    <?php
    $query = "SELECT * FROM tblresident2 WHERE id_resident='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();

    $query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position NOT IN ('')
                AND `status`='Incumbent'  AND `archive` = '0' ORDER BY `order` ASC";
    $result1 = $conn->query($query1);
    $officials = array();
    while ($row = $result1->fetch_assoc()) {
        $officials[] = $row;
    }

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Captain' OR tblposition.position='Barangay Chairman'  AND `archive` = '0'";
    $captain = $conn->query($c)->fetch_assoc();
    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Secretary'  AND `archive` = '0'";
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
                                            <div class="card-title">Certificate of Oneness</div>
                                            <div class="card-tools">
                                                <button class="btn btn-info btn-sm" onclick="printDiv('printThis')">
                                                    <i class="fa fa-print"></i>
                                                    Print Certificate
                                                </button>
                                                <a type="button" href="resident_cert_of_oneness.php" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to go back? You will have to repeat the process again from the previous page.')" data-original-title="Go Back">
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
                                                    <!-- <img style="margin-top: 10px;" src="assets/uploads/resident_profile/<?= $resident['picture'] ?>" class="img-fluid" width="200" />--><br><br>
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
                                                    <h1 class="mt-4 fw-bold mb-5" style="font-family: Book Antiqua; font-size: 30px;">CERTIFICATE OF ONENESS</h1>
                                                </div>

                                                <h2 class="mt-5 fw-bold" style="font-family: Book Antiqua;">
                                                    TO WHOM IT MAY CONCERN:
                                                </h2>

                                                <h2 class="mt-3" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                    <span class="fw-bold text-uppercase">This is to certify </span> that <span class="fw-bold text-uppercase" style="font-size:25px"><?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?></span>, of legal age, a bonafide resident of
                                                    <span>
                                                        <?php
                                                        $houseHNum = $resident['id_household'];
                                                        $queryHouseholdNumber = "SELECT * FROM tbl_household WHERE id_household='$houseHNum'";
                                                        $resultHouseholdNumber = $conn->query($queryHouseholdNumber);
                                                        $houseHoldNumber = $resultHouseholdNumber->fetch_assoc();

                                                        echo $houseHoldNumber['household_address'];
                                                        ?>
                                                        , <?= ucwords($brgy) ?>, <?= ucwords($resident['city']) ?> City</span>, is the same person listed in your master list named <span class="fw-bold text-uppercase"><?= $lname_before; ?>, <?= $fname_before; ?> <?= $mname_before; ?>.,</span> <?= $purpose ?>.
                                                </h2>

                                                <h2 class="mt-3" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                    This certification is issued upon the request of the above – named person for supporting document purpose and whatever legal purpose/s it may serve best.
                                                </h2>

                                                <h2 class="mt-3 mb-5" style="font-family: Book Antiqua; text-indent: 90px; line-height: 50px; text-align: justify;">
                                                    Issued this <span class="fw-bold" style="font-size:25px"><?= date("jS \of F Y") ?></span>, <?= $brgy ?>, City of <?= $town ?>.
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

                window.location.replace("model/save_transaction.php");
            }
        </script>
    </body>

    </html>
<?php
}
?>