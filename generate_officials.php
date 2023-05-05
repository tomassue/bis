<?php include 'server/server.php' ?>
<?php include 'model/fetch_brgy_info.php' ?>

<?php
$query = "SELECT * FROM tblofficials JOIN tblposition ON tblposition.id_position=tblofficials.id_position WHERE `archive` = '0' ORDER BY tblposition.id_position ASC ";
$result = $conn->query($query);

$current_officials = array();
while ($row = $result->fetch_assoc()) {
    $current_officials[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'templates/header.php' ?>
    <title>
        Barangay Officials - Barangay Management System
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

    table,
    td,
    th {
        border: 1px solid;
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
        <div class="container mb-5">
            <div class="row">
                <div class="col text-center">
                    <h2><?= strtoupper('List of Barangay Officials') ?></h2>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col text-left">
                    <h5>Term: <u><?= $termstart . ' to ' . $termended ?></u></h5>
                </div>
            </div> -->
        </div>
        <div class="table-responsive">
            <table id="residenttable" class="display table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Fullname</th>
                        <th scope="col">Chairmanship</th>
                        <th scope="col">Position</th>
                        <th scope="col">Term Started</th>
                        <th scope="col">Term Ended</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($current_officials)) : ?>
                        <?php foreach ($current_officials as $row) : ?>
                            <tr>
                                <td class="text-uppercase"><?= $row['honorifics'] ?> <?= $row['name'] ?></td>
                                <td style="width: 30%;">
                                    <?php
                                    $id_official = $row['id_officials'];
                                    $query_get_chair = "SELECT * FROM tblofficials_chairmanships JOIN tblchairmanship ON tblchairmanship.id_chairmanship=tblofficials_chairmanships.id_chairmanship WHERE `id_officials` = '$id_official'";
                                    $result_get_chair = $conn->query($query_get_chair);

                                    $get_chair = array();
                                    while ($chair_row = $result_get_chair->fetch_assoc()) {
                                        $get_chair[] = $chair_row;
                                    }

                                    if (!empty($get_chair)) {
                                        foreach ($get_chair as $get_chair_row) {
                                    ?>
                                            <span class="badge badge-pill badge-light mt-1 mb-1" style="color: black;"><?= $get_chair_row['title'] ?></span>
                                    <?php
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?= $row['position'] ?></td>
                                <td><?= $row['termstart'] ?></td>
                                <td><?= $row['termend'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">No Available Data</td>
                        </tr>
                    <?php endif ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
    <?php include 'templates/footer.php' ?>
</body>

</html>