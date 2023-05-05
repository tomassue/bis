<?php include 'server/server.php' ?>

<?php
if (isset($_POST["submit"])) {
    $id = $_POST['id_permit'];

    $recipients_name = $_POST['recipients_name'];
    $details = $_POST['details'];

    $_SESSION['recipients_name'] = $recipients_name;
    $_SESSION['details'] = $details;
    //$_SESSION['id_resident'] = $id; //id_resident

    //Those certificates that doesn't require payments, I'll be using this sesssion to determine where the save_transaction.php will be heading after the save_transaction.php is executed.
    $_SESSION['page'] = 'construction';
?>

    <?php
    $query = "SELECT * FROM tblpermit WHERE id_permit='$id'";
    $result = $conn->query($query);
    $permit = $result->fetch_assoc();

    $query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position NOT IN ('SK Chairrman')
                AND `status`='Incumbent' AND `archive` = '0' ORDER BY `order` ASC";
    $result1 = $conn->query($query1);
    $officials = array();
    while ($row = $result1->fetch_assoc()) {
        $officials[] = $row;
    }

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Captain' OR tblposition.position='Barangay Chairman' AND `archive` = '0'";
    $captain = $conn->query($c)->fetch_assoc();

    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.id_position=tblposition.id_position WHERE tblposition.position='Secretary' AND `archive` = '0'";
    $sec = $conn->query($s)->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'templates/header.php' ?>
        <title>Construction Clearance - Barangay Management System</title>
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
                top: 49px;
                left: 77px;
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

            .cntent {
                margin-left: 100px;
                margin-right: 100px;
            }

            li {
                display: list-item;
                text-align: -webkit-match-parent;
            }

            ol {
                list-style-type: decimal;
            }
        </style>
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
                                    <h2 class="text-white fw-bold">Generate Barangay Construction Clearance</h2>
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
                                            <div class="card-title">Barangay Construction Clearance</div>
                                            <div class="card-tools">
                                                <button class="btn btn-info btn-sm" onclick="printDiv('printThis')">
                                                    <i class="fa fa-print"></i>
                                                    Print Certificate
                                                </button>
                                                <a type="button" href="business_permit.php" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to go back? You will have to repeat the process again from the previous page.')" data-original-title="Go Back">
                                                    <i class="fas fa-file-alt"></i>&nbsp Go Back
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body bg-brgylogo m-5" id="printThis">
                                        <div class="cntent">
                                            <div class="d-flex flex-wrap justify-content-center" style="border-bottom:1px solid black">
                                                <div class="container">
                                                    <div class="row" id="cont">
                                                        <img id="brgylogo" style="width:150px; height: 150px;" src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" />

                                                        <div class="col-12 p-3 text-center" id="head">
                                                            <p class="fw-bold" style="font-size: 23px; font-family: Georgia; line-height: 28px;">Republic of the Philippines<br>City of <?= ucwords($town) ?><br><span class="text-uppercase"><?= ucwords($brgy) ?></span><br><br>OFFICE OF THE BARANGAY CHAIRMAN</p>
                                                            <br>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <h2 class="mt-4 fw-bold"> </h2>
                                                    </div>

                                                    <div class="text-center">
                                                        <h1 class="mt-4 mb-5" style="font-family: Copperplate Gothic Light; font-size: 35px;">Construction Clearance</h1>
                                                    </div>

                                                    <h2 class="mt-5" style="font-size: 30px; font-family: Forte;">
                                                        To whom it may concern:
                                                    </h2>

                                                    <h2 class="mt-3" style="font-family: Book Antiqua; text-indent: 70px; line-height: 28px; text-align: justify;">
                                                        <span class="fw-bold">BARANGAY CONSTRUCTION CLEARANCE</span> is hereby granted to <span class="text-uppercase fw-bold"><u><?= $permit['name'] ?></u></span> with project located at <span class="text-uppercase fw-bold"><u><?= $permit['location'] ?>.</u></span> After having verified, evaluated and inspected that the excavation/s covered by the said activity should be cleared from the following:
                                                    </h2>

                                                    <h2 class="mt-4" style="font-family: Book Antiqua; padding-left: 30px; line-height: 28px; text-align: justify;">
                                                        <ol>
                                                            <li>That the construction/excavation does not affect the Road Development Plan of the Barangay approved by the City Government authorities.</li>
                                                            <li>The said excavation/construction shall not affect neighbors or by passers.</li>
                                                            <li>The excavation/construction will not cause flooding.</li>
                                                            <li>The structure will not block passageways of interior residents outward to the existing road;</li>
                                                            <li>The construction/excavation shall not cause traffic in existing highways/roads</li>
                                                            <li>The structure and the activities to be performed within will not cause air or water pollution;</li>
                                                            <li>The establishment shall observe what is prohibited by law.</li>
                                                            <li>The corporation/company shall established preventive measures such as warning devices and the likes.</li>
                                                            <li>The corporation/company shall follow the other requisites from the Office of the City Building Official (OBO), and City Engineers Office.</li>
                                                        </ol>
                                                    </h2>

                                                    <br>

                                                    <h2 class="mt-4 mb-5" style="font-family: Book Antiqua; text-indent: 70px; line-height: 28px; text-align: justify;">
                                                        This <b>CERTIFICATION</b> is issued upon the request of the above named company in connection of allowing Constructing, Excavating, Installing, Maintain & Operate and for whatever legal purpose/s it may serve best.
                                                        <br>
                                                        <br>
                                                        <br>
                                                        Issued this <span class="fw-bold" style="font-size:25px"><?= date("jS \of F Y") ?></span> at Barangay 25, Cagayan de Oro City, Philippines.
                                                    </h2>

                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>

                                                    <div style="float: right;">
                                                        <h2 style="font-family: Book Antiqua; text-align: center; line-height: 25px;" class="mt-5"><u><span class="fw-bold text-uppercase"><?= ucwords($captain['name']) ?></span></u><br><span style="text-align: center;">Barangay Chairman</span>
                                                        </h2>
                                                        <p class="mr-3"></p>
                                                    </div>


                                                    <br>
                                                    <br>

                                                    <div style="margin-top: 10%;">
                                                        <h5 style="font-family: Book Antiqua; text-align: left; line-height: 20px;">Issued On<span style="font-family: Book Antiqua; margin-left: 30px;"><u><?= date("m-d-y") ?></u></span><br></h5>
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
                </div>

                <!-- Main Footer -->
                <?php include 'templates/main-footer.php' ?>
                <!-- End Main Footer -->
                <?php if (!isset($_GET['closeModal'])) { ?>

                    <script>
                        setTimeout(function() {
                            openModal();
                        }, 1000);
                    </script>
                <?php } ?>
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

                window.location.replace('model/save_transaction.php');
            }
        </script>
    </body>

    </html>
<?php } ?>