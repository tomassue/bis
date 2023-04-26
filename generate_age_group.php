<?php if (isset($_POST['submit'])) : ?>

    <?php include 'server/server.php' ?>
    <?php include 'model/fetch_brgy_info.php' ?>

    <?php

    if (!isset($_SESSION['username'])) {
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $min = $conn->real_escape_string($_POST['min']);
    $max = $conn->real_escape_string($_POST['max']);

    $query = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), birthdate)), '%Y') + 0 AS age FROM tblresident2 WHERE resident_type=1 HAVING age >= '$min' AND age <= '$max'";
    $result = $conn->query($query);
    $resident = array();
    while ($row = $result->fetch_assoc()) {
        $resident[] = $row;
    }



    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Household - Print</title>
    </head>
    <?php include 'templates/header.php' ?>
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
            opacity: 0.1;
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

    <body onload="window.print()">
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
        <hr>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2><?= strtoupper('List of Residents that ages from ' . $min . ' to ' . $max) ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-left">
                        <!-- <h5 class="fw-bold">Count: <u><?= number_format($hnumCount) ?></u></h5> -->
                    </div>
                </div>
            </div><br><br><br>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="display table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Fullname</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Age</th>
                                <th scope="col">Address</th>
                                <th scope="col">PWD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($resident)) : ?>
                                <?php $no = 1;
                                foreach ($resident as $row) : ?>
                                    <tr>
                                        <td><?= $no ?></td>

                                        <td><?= $row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['ext'] ?></td>
                                        <td><?= $row['birthdate'] ?></td>
                                        <?php
                                        $DateOfBirth = $row['birthdate'];

                                        $dob = new DateTime($DateOfBirth);
                                        $now = new DateTime();
                                        $diff = $now->diff($dob);
                                        ?>
                                        <td><?= $diff->y; ?></td>
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
                                        <td><?= $row['pwd'] ?></td>
                                    </tr>
                                <?php $no++;
                                endforeach ?>
                            <?php endif ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Age</th>
                                <th scope="col">Address</th>
                                <th scope="col">PWD</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <?php include 'templates/footer.php' ?>

            <script>
                // $(document).ready(function() {
                //     $('#residenttable').DataTable();
                // });

                //don't forget to find and remove style if you don't want all you documents stay in landscape
            </script>
    </body>

    </html>

<?php else : ?>

    <?php header("Location: index.php"); ?>

<?php endif ?>