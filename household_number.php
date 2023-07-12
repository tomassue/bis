<?php include 'server/server.php' ?>

<?php if ($_SESSION['role'] == 'administrator') : ?>
    <?php
    $query = "SELECT * FROM tbl_household";
    $result = $conn->query($query);

    $household_number = array();
    while ($row = $result->fetch_assoc()) {
        $household_number[] = $row;
    }

    $query2 = "SELECT * FROM tblpurok ORDER BY purok_name ASC";
    $result2 = $conn->query($query2);
    $purok = array();
    while ($row = $result2->fetch_assoc()) {
        $purok[] = $row;
    }

    $count = "SELECT * FROM tbl_household";
    $countresult = $conn->query($count);
    $active = $countresult->num_rows;

    $count2 = "SELECT * FROM tbl_household WHERE household_type='residential'";
    $countresult2 = $conn->query($count2);
    $active2 = $countresult2->num_rows;

    $count3 = "SELECT * FROM tbl_household WHERE household_type='apartment'";
    $countresult3 = $conn->query($count3);
    $active3 = $countresult3->num_rows;

    $count4 = "SELECT * FROM tbl_household WHERE household_type='boarding house'";
    $countresult4 = $conn->query($count4);
    $active4 = $countresult4->num_rows;
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

                                <!-- Card With Icon States Color -->
                                <div class="row justify-content-center">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card card-stats card-round">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="fa fa-home text-dark"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <a href="javascript:void(0)" id="all_Household" class="card-link text-muted">
                                                                <p class="card-category">Total Household</p>
                                                            </a>
                                                            <h4 class="card-title"><?= number_format($active) ?></h4>
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
                                                            <i class="fa fa-home text-warning"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <a href="javascript:void(0)" id="residential_Household" class="card-link text-muted">
                                                                <p class="card-category">Total Residential/s</p>
                                                            </a>
                                                            <h4 class="card-title"><?= number_format($active2) ?></h4>
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
                                                            <i class="fa fa-home text-info"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <a href="javascript:void(0)" id="apartment_Household" class="card-link text-muted">
                                                                <p class="card-category">Total Apartment/s</p>
                                                            </a>
                                                            <h4 class="card-title"><?= number_format($active3) ?></h4>
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
                                                            <i class="fa fa-home text-secondary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <a href="javascript:void(0)" id="boardinghouse_Household" class="card-link text-muted">
                                                                <p class="card-category">Total Boarding House/s</p>
                                                            </a>
                                                            <h4 class="card-title"><?= number_format($active4) ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card With Icon States Background -->

                                <!-- <div class="row">
                                    <div class="col">
                                        <div class="card card-stats card-round" style="background-color:black;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="icon-big text-center">
                                                            <i class="fa fa-home" style="color:white;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 col-stats">
                                                    </div>
                                                    <div class="col-6 col-stats">
                                                        <div class="numbers">
                                                            <p class="card-category" style="color:white;">Total Household/s</p>
                                                            <h4 class="card-title" style="color:white;"><?= number_format($active) ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="javascript:void(0)" id="all_Household" class="card-link text-light">Show all</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card card-stats card-round" style="background-color:black;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="icon-big text-center">
                                                            <i class="fa fa-home" style="color:white;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 col-stats">
                                                    </div>
                                                    <div class="col-6 col-stats">
                                                        <div class="numbers">
                                                            <p class="card-category" style="color:white;">Total Residential/s</p>
                                                            <h4 class="card-title" style="color:white;"><?= number_format($active2) ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="javascript:void(0)" id="residential_Household" class="card-link text-light">Residential/s</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card card-stats card-round" style="background-color:black;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="icon-big text-center">
                                                            <i class="fa fa-home" style="color:white;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 col-stats">
                                                    </div>
                                                    <div class="col-6 col-stats">
                                                        <div class="numbers">
                                                            <p class="card-category" style="color:white;">Total Apartment/s</p>
                                                            <h4 class="card-title" style="color:white;"><?= number_format($active3) ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="javascript:void(0)" id="apartment_Household" class="card-link text-light">Apartment/s</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card card-stats card-round" style="background-color:black;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="icon-big text-center">
                                                            <i class="fa fa-home" style="color:white;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 col-stats">
                                                    </div>
                                                    <div class="col-6 col-stats">
                                                        <div class="numbers">
                                                            <p class="card-category" style="color:white;">Total Boarding House/s</p>
                                                            <h4 class="card-title" style="color:white;"><?= number_format($active4) ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="javascript:void(0)" id="boardinghouse_Household" class="card-link text-light">Boarding House/s</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <?php if (isset($_SESSION['message'])) : ?>
                                    <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                        <?php echo $_SESSION['message']; ?>
                                    </div>
                                    <?php unset($_SESSION['message']); ?>
                                <?php endif ?>

                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Household Number</div>
                                            <div class="card-tools">
                                                <!-- <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm"> -->
                                                <a href="#add" data-toggle="modal" class="btn btn-info btn-sm">
                                                    <i class="fa fa-plus"></i> &nbsp
                                                    Household Number
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="householdnumTable" class="display table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Household Number</th>
                                                        <th scope="col">House No.</th>
                                                        <th scope="col">Zone</th>
                                                        <th scope="col">Street Name</th>
                                                        <th scope="col">Address (Details)</th>
                                                        <th scope="col">House Type</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($household_number)) : ?>
                                                        <?php $no = 1;
                                                        foreach ($household_number as $row) : ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $row['household_number'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['house_no'] == 0) {
                                                                        echo 'N/A';
                                                                    } else {
                                                                        echo $row['house_no'];
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $purok_id =  $row['id_purok'];
                                                                    $queryPurok = "SELECT * FROM tblpurok WHERE id_purok='$purok_id'";
                                                                    $resultqueryPurok = $conn->query($queryPurok);
                                                                    $purokName = $resultqueryPurok->fetch_assoc();

                                                                    echo $purokName['purok_name'];
                                                                    ?>
                                                                </td>
                                                                <td><?= $row['household_street_name'] ?></td>
                                                                <td><?= $row['household_address'] ?></td>
                                                                <td>
                                                                    <?php if ($row['household_type'] == 'apartment') : ?>
                                                                        <span class="badge badge-info"> <?= ucwords($row['household_type']) ?></span>
                                                                    <?php elseif ($row['household_type'] == 'residential') : ?>
                                                                        <span class="badge badge-warning"> <?= ucwords($row['household_type']) ?></span>
                                                                    <?php elseif ($row['household_type'] == 'boarding house') : ?>
                                                                        <span class="badge badge-secondary"> <?= ucwords($row['household_type']) ?></span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <div class="form-button-action">
                                                                        <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Purok" onclick="editHouseholdNumber(this)" data-household="<?= $row['household_number'] ?>" data-house_no="<?= $row['house_no'] ?>" data-household_purok="<?= $row['id_purok'] ?>" data-household_street_name="<?= $row['household_street_name'] ?>" data-household_address="<?= $row['household_address'] ?>" data-household_type="<?= $row['household_type'] ?>" data-id="<?= $row['id_household'] ?>">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <!-- <a type="button" data-toggle="tooltip" href="model/remove_household_number.php?id=<?= $row['id_household'] ?>" onclick="return confirm('Are you sure you want to delete this household number?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </a> -->
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
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Household Number</th>
                                                        <th scope="col">House No.</th>
                                                        <th scope="col">Zone</th>
                                                        <th scope="col">Street Name</th>
                                                        <th scope="col">Address (Details)</th>
                                                        <th scope="col">House Type</th>
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

                <!--Add household number Modal -->
                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Purok</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="model/save_household_number.php">
                                    <div class="form-group">
                                        <label>Household No.</label>
                                        <input type="number" class="form-control" placeholder="Enter Household no." name="household_number" required>
                                    </div>
                                    <div class="form-group">
                                        <label>House No.</label>
                                        <input type="number" class="form-control" placeholder="Enter House no." name="house_no">
                                    </div>
                                    <div class="form-group">
                                        <label for="household_purok">Purok/Zone</label>
                                        <select class="form-control" name="household_purok">
                                            <option disabled selected>Choose...</option>
                                            <?php foreach ($purok as $row) : ?>
                                                <option value="<?= $row['id_purok'] ?>"><?= $row['purok_name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Street Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Street Name." name="household_street_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="HouseType">House Type</label>
                                        <select class="form-control" name="household_type">
                                            <option disabled selected>Choose...</option>
                                            <option value="apartment">Apartment</option>
                                            <option value="residential">Residential</option>
                                            <option value="boarding house">Boarding House</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name of Subdivision/Apartment/Boarding House/etc.</label>
                                        <input type="text" class="form-control" placeholder="Enter Subdivision/Apartment/Boarding House/etc." name="household_address">
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

                <!--Edit Household Modal -->
                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Purok</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="model/edit_household_number.php">
                                    <div class="form-group">
                                        <label>Household No.</label>
                                        <input type="number" class="form-control" id="household_number" placeholder="Enter Household no." name="household_number" required>
                                    </div>
                                    <div class="form-group">
                                        <label>House No.</label>
                                        <input type="number" class="form-control" placeholder="Enter House no." name="house_no" id="house_no">
                                    </div>
                                    <div class="form-group">
                                        <label for="household_purok">Purok/Zone</label>
                                        <select class="form-control" name="household_purok" id="household_purok">
                                            <option disabled selected>Choose...</option>
                                            <?php foreach ($purok as $row) : ?>
                                                <option value="<?= $row['id_purok'] ?>"><?= $row['purok_name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Street Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Street Name." name="household_street_name" id="household_street_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="HouseType">House Type</label>
                                        <select class="form-control" name="household_type" id="household_type">
                                            <option disabled selected>Choose...</option>
                                            <option value="apartment">Apartment</option>
                                            <option value="residential">Residential</option>
                                            <option value="boarding house">Boarding House</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name of Subdivision/Apartment/Boarding House/etc.</label>
                                        <input type="text" class="form-control" placeholder="Enter Subdivision/Apartment/Boarding House/etc." name="household_address" id="household_address">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="id_household" name="id_household">
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
                var oTable = $('#householdnumTable').DataTable({
                    "order": [
                        [1, "asc"]
                    ]
                });

                $("#all_Household").click(function() {
                    var textSelected = ' ';
                    oTable.columns(6).search(textSelected).draw();
                });

                $("#residential_Household").click(function() {
                    var textSelected = 'Residential';
                    oTable.columns(6).search(textSelected).draw();
                });
                $("#apartment_Household").click(function() {
                    var textSelected = 'Apartment';
                    oTable.columns(6).search(textSelected).draw();
                });
                $("#boardinghouse_Household").click(function() {
                    var textSelected = 'Boarding House';
                    oTable.columns(6).search(textSelected).draw();
                });
            });
        </script>
    </body>

    </html>
<?php else : ?>
    <?php header("Location: index.php"); ?>
<?php endif; ?>