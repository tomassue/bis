<?php include 'server/server.php' ?>

<?php if ($_SESSION['role'] == 'administrator') : ?>
    <?php
    $query = "SELECT * FROM tbl_p_medication_and_other_services ORDER BY `med_or_services_name`";
    $result = $conn->query($query);

    $med_or_service = array();
    while ($row = $result->fetch_assoc()) {
        $med_or_service[] = $row;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'templates/header.php' ?>
        <title>Services and Medication - Barangay Management System</title>
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
                                            <div class="card-title">Services and Medication</div>
                                            <div class="card-tools">
                                                <!-- <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm"> -->
                                                <a href="#add" data-toggle="modal" class="btn btn-info btn-sm">
                                                    <i class="fa fa-plus"></i> &nbsp
                                                    Service or Medication
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Service or Medication</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($med_or_service)) : ?>
                                                        <?php $no = 1;
                                                        foreach ($med_or_service as $row) : ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $row['med_or_services_name'] ?></td>
                                                                <td>
                                                                    <div class="form-button-action">
                                                                        <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Service or Medication" onclick="editMedOrService(this)" data-name="<?= $row['med_or_services_name'] ?>" data-id="<?= $row['id_med_other_services'] ?>">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <!-- <a type="button" data-toggle="tooltip" href="model/remove_purok.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this purok?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a> -->
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php $no++;
                                                        endforeach ?>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td colspan="3" class="text-center">No Available Data</td>
                                                        </tr>
                                                    <?php endif ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Service or Medication</th>
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

                <!-- Add Modal -->
                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Service or Medication</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="model/save_p_services_and_medication.php">
                                    <div class="form-group">
                                        <label>Name of the Service or Medication</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" name="med_or_services_name" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Service or Medication</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="model/edit_p_services_and_medication.php">
                                    <div class="form-group">
                                        <label>Name of the Service or Medication</label>
                                        <input type="text" class="form-control" id="med_or_services_name" placeholder="Enter Name" name="med_or_services_name" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="ms_id" name="ms_id">
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
    </body>

    </html>
<?php else : ?>
    <?php header("Location: index.php"); ?>
<?php endif; ?>