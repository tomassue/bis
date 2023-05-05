<?php include 'server/server.php' ?>

<?php if ($_SESSION['role'] == 'administrator') : ?>
    <?php
    $query = "SELECT * FROM tblofficials JOIN tblposition ON tblposition.id_position=tblofficials.id_position WHERE `archive` = '1' ORDER BY tblposition.id_position ASC ";
    $result = $conn->query($query);

    $archived_officials = array();
    while ($row = $result->fetch_assoc()) {
        $archived_officials[] = $row;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'templates/header.php' ?>
        <title>Barangay Purok - Barangay Management System</title>
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
                                    <h2 class="text-white fw-bold">Settings</h2>
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
                                            <div class="card-title">Barangay Officials Archives</div>
                                            <div class="card-tools">
                                                <!-- <button class="btn btn-info btn-sm" onclick="location.href='generate_officials_archives.php'">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button> -->
                                                <a type="button" href="#print_officials_archives" data-toggle="modal" class="btn btn-sm btn-primary" title="Print">
                                                    <i class="fas fa-print"></i>&nbsp Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="officials_archives">
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
                                                    <?php if (!empty($archived_officials)) : ?>
                                                        <?php
                                                        foreach ($archived_officials as $row) : ?>
                                                            <tr>
                                                                <td class="text-uppercase"><?= $row['honorifics'] ?> <?= $row['name'] ?></td>
                                                                <td style="width: 50%;">
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
                                                                            <span class="badge badge-pill badge-secondary mt-1 mb-1"><?= $get_chair_row['title'] ?></span>
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
                                                    <?php endif ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">Fullname</th>
                                                        <th scope="col">Chairmanship</th>
                                                        <th scope="col">Position</th>
                                                        <th scope="col">Term Started</th>
                                                        <th scope="col">Term Ended</th>
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

                <div class="modal fade" id="print_officials_archives" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Purok</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="generate_officials_archives.php">
                                    <div class="form-group">
                                        <label>Term Started</label>
                                        <input type="date" class="form-control" name="termstarted" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Term Ended</label>
                                        <input type="date" class="form-control" name="termended" required>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="print_official_archives">Print</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <!-- <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Purok</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="model/save_purok.php">
                                    <div class="form-group">
                                        <label>Purok Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Purok Name" name="purok" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Purok Details(Optional)</label>
                                        <textarea class="form-control" placeholder="Set Bounderies for each Purok" name="details"></textarea>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> -->

                <!-- Modal -->
                <!-- <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Purok</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="model/edit_purok.php">
                                    <div class="form-group">
                                        <label>Purok Name</label>
                                        <input type="text" class="form-control" id="purok" placeholder="Enter Purok Name" name="purok" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Purok Details(Optional)</label>
                                        <textarea class="form-control" id="details" placeholder="Set Bounderies for each Purok" name="details"></textarea>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="purok_id" name="id">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> -->

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
            $(document).ready(function() {
                $('#officials_archives').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel'
                    ]
                });
            });
        </script>
    </body>

    </html>
<?php else : ?>
    <?php header("Location: index.php"); ?>
<?php endif; ?>