<?php include 'server/server.php' ?>
<?php
$state = $_GET['state'];
$purok = array();

if ($state == 'purok') {
    $query = "SELECT * FROM tblpurok ORDER BY `purok_name`";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $purok[] = $row;
    }
} else {
    $query = "SELECT * FROM tblprecinct";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $purok[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Barangay Zones - Barangay Management System</title>
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
                                <h2 class="text-white fw-bold"><?= $state == 'purok' ? 'Purok' : 'Precint' ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="col-md-3">
                        <div class="card card-stats card-round" style="<?= $state == 'purok' ? 'background-color:black; color:white' : 'background-color:black; color:white' ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-fingerprint"></i>
                                        </div>
                                    </div>
                                    <div class="col-3 col-stats">
                                    </div>
                                    <div class="col-6 col-stats ">
                                        <div class="numbers">
                                            <p class="card-category text-light"><?= $state == 'purok' ? 'Total Zones' : 'Total Precint' ?></p>
                                            <h4 class="card-title text-light"><?= number_format(count($purok)) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt--2">
                        <div class="col">
                            <?php if (isset($_SESSION['message'])) : ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title"><?= $state == 'purok' ? 'Zones Information' : 'Precint Information' ?></div>
                                        <div class="card-tools">
                                            <button class="btn btn-info btn-sm" onclick="location.href='generate_purok_info.php?state=purok'">
                                                <i class="fa fa-print"></i>
                                                Print
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="puroktable" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col"><?= $state == 'purok' ? 'Zone No.' : 'Precint No.' ?></th>
                                                    <th scope="col">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($purok)) : ?>
                                                    <?php $no = 1;
                                                    foreach ($purok as $row) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $state != 'purok' ? $row['precinct'] : $row['purok_name'] ?></td>
                                                            <td><?= $row['purok_details'] ?></td>
                                                        </tr>
                                                    <?php $no++;
                                                    endforeach ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">No Available Data</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col"><?= $state == 'purok' ? 'Purok No.' : 'Precint No.' ?></th>
                                                    <th scope="col">Details</th>
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
        </div>

        <!-- Main Footer -->
        <?php include 'templates/main-footer.php' ?>
        <!-- End Main Footer -->

    </div>

    </div>
    <?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="assets/js/plugin/moment/moment.min.js"></script>
    <script src="assets/js/plugin/dataTables.dateTime.min.js"></script>
    <script src="assets/js/plugin/datatables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/plugin/datatables/Buttons-1.6.1/js/buttons.print.min.js"></script>

    <!-- START ONLINE DATATABLES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>
    <!-- END ONLINE DATATABLES -->

    <script>
        // $(document).ready(function() {
        //     $('#residenttable').DataTable();
        // });

        $(document).ready(function() {
            $('#puroktable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel'
                ]
            });
        });
    </script>
</body>

</html>