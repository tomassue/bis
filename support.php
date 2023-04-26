<?php include 'server/server.php' ?>

<?php if ($_SESSION['role'] == 'administrator') : ?>
    <?php
    /*$query = "SELECT * FROM tbl_support ORDER BY `date` DESC";*/
    $query = "SELECT *, tbl_support.id_support as id, tbl_users.id_user as user_id FROM tbl_support JOIN tbl_users ON tbl_users.id_user=tbl_support.id_user ORDER BY tbl_support.status_support ASC";
    $result = $conn->query($query);

    $ticket = array();
    while ($row = $result->fetch_assoc()) {
        $ticket[] = $row;
    }

    $querySupportPending = "SELECT * FROM tbl_support WHERE status_support = 'pending'";
    $resultSupportPending = $conn->query($querySupportPending)->num_rows;

    $querySupportResolved = "SELECT * FROM tbl_support WHERE status_support = 'resolved'";
    $resultSupportResolved = $conn->query($querySupportResolved)->num_rows;
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'templates/header.php' ?>
        <title>Support Management - Barangay Management System</title>
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

                                <!-- Card With Icon States Color -->
                                <div class="row justify-content-center">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card card-stats card-round">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="fa fa-edit text-danger"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <a class="card-link text-muted" href="javascript:void(0)" id="pending">Pending</a>
                                                            <h4 class="card-title"><?= number_format($resultSupportPending) ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card card-stats card-round">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="fa fa-check text-success"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <a class="card-link text-muted" href="javascript:void(0)" id="resolved">Resolved</a>
                                                            <h4 class="card-title"><?= number_format($resultSupportResolved) ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card With Icon States Background -->

                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Support Management</div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="tableSupport">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Username</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Subject</th>
                                                        <th scope="col">Number</th>
                                                        <th scope="col">Message</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($ticket)) : ?>
                                                        <?php $no = 1;
                                                        foreach ($ticket as $row) : ?>
                                                            <tr>
                                                                <td><?= $row['user_username'] ?></td>
                                                                <td><?= ucwords($row['user_lastname'] . ', ' . $row['user_firstname'] . ' ' . $row['user_middlename']) ?></td>
                                                                <td><?= $row['subject'] ?></td>
                                                                <td><a href="tel:<?= $row['number'] ?>"><?= $row['number'] ?></a></td>
                                                                <td><?= $row['message'] ?></td>
                                                                <td>
                                                                    <?php if ($row['status_support'] == 'pending') : ?>
                                                                        <span class="badge badge-danger"><?= ucwords($row['status_support']) ?></span>
                                                                    <?php else : ?>
                                                                        <span class="badge badge-success"><?= ucwords($row['status_support']) ?></span>
                                                                    <?php endif ?>
                                                                </td>
                                                                <td><?= $row['date'] ?></td>
                                                                <td>
                                                                    <div class="form-button-action">
                                                                        <!-- <a type="button" data-toggle="tooltip" href="model/remove_ticket.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to remove this support/ticket?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                            <i class="fa fa-times"></i>
                                                                        </a> -->
                                                                        <a type="button" data-toggle="modal" href="#edit_support" onclick="alert('Are you sure you want to edit this support/ticket?');
                                                                        editSupport(this)" data-status_support="<?= $row['status_support'] ?>" data-id_support="<?= $row['id_support'] ?>" class=" btn btn-link btn-info" data-original-title="Edit">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $no++;
                                                        endforeach ?>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td colspan="8" class="text-center">No Available Data</td>
                                                        </tr>
                                                    <?php endif ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">Username</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Subject</th>
                                                        <th scope="col">Number</th>
                                                        <th scope="col">Message</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
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

                <div class="modal fade" id="edit_support" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Support Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="model/edit_support.php">
                                    <div class="form-group">
                                        <label for="support_status">Status</label>
                                        <select class="form-control" name="status_support" id="status_support">
                                            <option disabled selected>- Select -</option>
                                            <option value="pending">Pending</option>
                                            <option value="resolved">Resolved</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_support" id="id_support">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
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
        <script>
            $(document).ready(function() {
                var oTable = $('#tableSupport').DataTable({
                    "order": [
                        [3, "asc"]
                    ]
                });

                $("#pending").click(function() {
                    var textSelected = 'Pending';
                    oTable.columns(5).search(textSelected).draw();
                });

                $("#resolved").click(function() {
                    var textSelected = 'Resolved';
                    oTable.columns(5).search(textSelected).draw();
                });
            });

            $(function() {
                $("#comp_name").autocomplete({
                    source: 'backend-script.php'
                });
            });

            $(function() {
                $("#resp_name").autocomplete({
                    source: 'backend-script2.php' //FOR FETCHING RESIDENT FOR COMPLAIN
                });
            });

            //DISABLE PAST DATES INPUT
            var today = new Date().toISOString().split('T')[0];
            document.getElementsByName("blotter_date")[0].setAttribute('min', today);
        </script>
    </body>

    </html>
<?php else : ?>
    <?php header("Location: index.php"); ?>
<?php endif; ?>