<?php include 'server/server.php' ?>
<?php include 'model/fetch_brgy_info.php' ?>

<?php

//"SELECT *, tblresident.id as id, tblpurok.id as purok_id, tbl_org.id as org_id FROM tblresident JOIN tblpurok ON tblpurok.id=tblresident.purok JOIN tbl_org ON tbl_org.id=tblresident.organization ";

$state = $_GET['state'];

if ($state == 'male') {
    // $query = "SELECT * FROM tblresident WHERE sex='Male' AND resident_type=1";
    // $result = $conn->query($query);
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.sex='Male' AND tblresident2.resident_type=1";
    $result = $conn->query($query);


    $query1 = "SELECT * FROM tblresident2 WHERE sex='Male' AND resident_type=1";
    $result1 = $conn->query($query1);
    $male = $result1->num_rows;
} elseif ($state == 'female') {
    // $query = "SELECT * FROM tblresident WHERE sex='Female' AND resident_type=1";
    // $result = $conn->query($query);
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.sex='Female' AND tblresident2.resident_type=1";
    $result = $conn->query($query);

    $query2 = "SELECT * FROM tblresident2 WHERE sex='Female' AND resident_type=1";
    $result2 = $conn->query($query2);
    $female = $result2->num_rows;
} elseif ($state == 'non_voters') {
    /*$query = "SELECT * FROM tblresident WHERE voterstatus='No' AND resident_type=1";
        $result = $conn->query($query);*/
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='No' AND tblresident2.resident_type=1";
    $result = $conn->query($query);

    $query4 = "SELECT * FROM tblresident2 WHERE vstatus='No' AND resident_type=1";
    $non = $conn->query($query4)->num_rows;
} elseif ($state == 'voters') {
    /*$query = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND resident_type=1";
        $result = $conn->query($query);*/
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='Yes' AND tblresident2.resident_type=1";
    $result = $conn->query($query);

    // $query1 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND identified_as='Positive' AND resident_type=1";
    $query1 = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='Yes' AND tblresident2.identified_as='Positive' AND tblresident2.resident_type=1";
    $pos = $conn->query($query1)->num_rows;

    // $query2 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND identified_as='Negative' AND resident_type=1";
    $query2 = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='Yes' AND tblresident2.identified_as='Negative' AND tblresident2.resident_type=1";
    $nega = $conn->query($query2)->num_rows;

    // $query3 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND identified_as='Unidentified' AND resident_type=1";
    $query3 = "SELECT * FROM tblresident2 WHERE tblresident2.vstatus='Yes' AND tblresident2.identified_as='Unidentified' AND tblresident2.resident_type=1";
    $unid = $conn->query($query3)->num_rows;

    $query4 = "SELECT * FROM tblresident2 WHERE vstatus='Yes' AND resident_type=1";
    $result4 = $conn->query($query4);
    $totalvoters = $result4->num_rows;
} elseif ($state == 'senior-citizens') {
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.id_org=1";
    $result = $conn->query($query);

    $query10 = "SELECT * FROM tblresident2 WHERE id_org='1'";
    $sc = $conn->query($query10)->num_rows;
} elseif ($state == 'pwd') {
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.pwd='Yes'";
    $result = $conn->query($query);

    $query11 = "SELECT * FROM tblresident2 WHERE pwd='Yes'";
    $pwd = $conn->query($query11)->num_rows;
} elseif ($state == 'deceased') {
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.resident_type=0"; //SHOWS 0 (deceased)
    $result = $conn->query($query);

    $query12 = "SELECT * FROM tblresident2 WHERE resident_type=0";
    $deceased = $conn->query($query12)->num_rows;
} elseif ($state == 'indigent') {
    $query = "SELECT * FROM tblresident2 WHERE tblresident2.indigent='Yes'";
    $result = $conn->query($query);

    $query13 = "SELECT * FROM tblresident2 WHERE indigent='Yes'";
    $indigent = $conn->query($query13)->num_rows;
} else {
    $query = "SELECT * FROM tblresident2";
    $result = $conn->query($query);
}

$resident = array();
while ($row = $result->fetch_assoc()) {
    $resident[] = $row;
}

?>

<!DOCTYPE html>
<html>

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
                    <?php if ($state == 'male') : ?>
                        <h2><?= strtoupper('List of Male Resident/s') ?></h2>
                    <?php elseif ($state == 'female') : ?>
                        <h2><?= strtoupper('List of Female Resident/s') ?></h2>
                    <?php elseif ($state == 'non_voters') : ?>
                        <h2><?= strtoupper('List of Non-voter/s') ?></h2>
                    <?php elseif ($state == 'voters') : ?>
                        <h2><?= strtoupper('List of Voter/s') ?></h2>
                    <?php elseif ($state == 'senior-citizens') : ?>
                        <h2><?= strtoupper('List of Senior Citizen/s') ?></h2>
                    <?php elseif ($state == 'pwd') : ?>
                        <h2><?= strtoupper('List of Pwd') ?></h2>
                    <?php elseif ($state == 'deceased') : ?>
                        <h2><?= strtoupper('List of Deceased Resident/s') ?></h2>
                    <?php elseif ($state == 'indigent') : ?>
                        <h2><?= strtoupper('List of Indigent Resident/s') ?></h2>
                    <?php else : ?>
                        <h2><?= strtoupper('List of Resident/s') ?></h2>
                    <?php endif ?>
                </div>
            </div>
            <div class="row">
                <div class="col text-left">
                    <?php if ($state == 'male') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($male) ?></u></h5>
                    <?php elseif ($state == 'female') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($female) ?></u></h5>
                    <?php elseif ($state == 'non_voters') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($non) ?></u></h5>
                    <?php elseif ($state == 'voters') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($totalvoters) ?></u></h5>
                    <?php elseif ($state == 'senior-citizens') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($sc) ?></u></h5>
                    <?php elseif ($state == 'pwd') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($pwd) ?></u></h5>
                    <?php elseif ($state == 'deceased') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($deceased) ?></u></h5>
                    <?php elseif ($state == 'indigent') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($indigent) ?></u></h5>
                    <?php else : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format(count($resident)) ?></u></h5>
                    <?php endif ?>
                </div>
            </div>
        </div>
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
                                    <!-- <div class="avatar avatar-xs">
                                    <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                </div> -->
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
    <?php include 'templates/footer.php' ?>

    <script>
        // $(document).ready(function() {
        //     $('#residenttable').DataTable();
        // });
    </script>
</body>

</html>