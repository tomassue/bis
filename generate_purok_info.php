<?php include 'server/server.php' ?>
<?php include 'model/fetch_brgy_info.php' ?>

<?php

$state = $_GET['state'];

if ($state == 'purok') {
    $query = "SELECT * FROM tblpurok ORDER BY `purok_name`";
    $result = $conn->query($query);

    $query1 = "SELECT * FROM tblpurok ORDER BY `purok_name`";
    $result1 = $conn->query($query1);
    $purok = $result1->num_rows;
}

$puroks = array();
while ($row = $result->fetch_assoc()) {
    $puroks[] = $row;
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'templates/header.php' ?>
    <title>
        <?php if ($state == 'purok') : ?>
            Zone Information - Barangay Management Systems
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
                    <?php if ($state == 'purok') : ?>
                        <h2><?= strtoupper('List of Zone/s') ?></h2>
                    <?php endif ?>
                </div>
            </div>
            <div class="row">
                <div class="col text-left">
                    <?php if ($state == 'purok') : ?>
                        <h5 class="fw-bold">Count: <u><?= number_format($purok) ?></u></h5>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="display table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Zone No.</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($puroks)) : ?>
                        <?php $no = 1;
                        foreach ($puroks as $row) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['purok_name'] ?></td>
                                <td><?= $row['purok_details'] ?></td>
                            </tr>
                        <?php $no++;
                        endforeach ?>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Zone No.</th>
                        <th scope="col">Details</th>
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