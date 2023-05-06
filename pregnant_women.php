<?php include 'server/server.php' ?>
<?php

$sql = "SELECT * FROM tbl_p_fam_members";
$result = $conn->query($sql);

$fam_members = array();
while ($row = $result->fetch_assoc()) {
    $fam_members[] = $row;
}

$queryResident = "SELECT * FROM tblresident2";
$resultResident = $conn->query($queryResident);

$getResident = array();
while ($row = $resultResident->fetch_assoc()) {
    $getResident[] = $row;
}

$queryHousehold = "SELECT * FROM tbl_household JOIN tblpurok ON tblpurok.id_purok=tbl_household.id_purok";
$resultHousehold = $conn->query($queryHousehold);

$getHousehold = array();
while ($row2 = $resultHousehold->fetch_assoc()) {
    $getHousehold[] = $row2;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
    <title>Barangay Pregnant Women - Barangay Management System</title>

    <!-- Select2 CSS -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="assets/css/select2.min.css" />
    <!-- <link rel="stylesheet" href="/path/to/select2.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
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
                                <h2 class="text-white fw-bold">Pregnant Women</h2>
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
                                        <div class="card-title">List of Pregnant Women</div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                            <div class="card-tools">
                                                <a href="#addmother" data-toggle="modal" class="btn btn-info btn-sm">
                                                    <i class="fa fa-plus"></i>&nbsp
                                                    Add a Mother
                                                </a>
                                                <!-- <a type="button" href="generate_officials.php" class="btn btn-sm btn-secondary" title="Print">
                                                    <i class="fas fa-print"></i>&nbsp Print
                                                </a> -->
                                                <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                    <!-- <a href="model/archive_officials.php" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to archive the BRGY OFFICIALS?')">
                                                        <i class="fas fa-file-archive"></i>&nbsp
                                                        Archive
                                                    </a> -->
                                                <?php endif; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="pregnantwomen" class="display table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($fam_members)) : ?>
                                                    <?php $no = 1;
                                                    foreach ($fam_members as $row) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $row['id_resident'] ?></td>
                                                            <td>Action here</td>
                                                        </tr>
                                                    <?php $no++;
                                                    endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Amount</th>
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

            <!-- Add Mother modal -->
            <div class="modal fade bd-example-modal-lg" id="addmother" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Mother</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="bodyadd">
                            <label><b>I. </b>MOTHER'S INFORMATION</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mother</label>
                                        <select class="form-control js-states" style="width:100%;" id="mother" name="id_resident[]" required>
                                            <?php foreach ($getResident as $row) : ?>
                                                <option value=""></option>
                                                <option value="<?= $row['id_resident'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                        <input type="hidden" value="mother" name="family_role[]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="text" class="form-control" id="birthdate" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cellphone (kung meron)</label>
                                        <input type="text" class="form-control" id="phone" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Blood Type</label>
                                        <input type="text" class="form-control" name="blood_type[]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trabaho</label>
                                        <input type="text" class="form-control" id="occupation" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label><b>II. </b>FATHER'S INFORMATION</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Father</label>
                                        <select class="form-control js-states" style="width:100%;" id="father" name="id_resident[]" required>
                                            <?php foreach ($getResident as $row) : ?>
                                                <option value=""></option>
                                                <option value="<?= $row['id_resident'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                        <input type="hidden" value="father" name="family_role[]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cellphone (kung meron)</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Blood Type</label>
                                        <input type="text" class="form-control" name="blood_type[]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trabaho</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label><b>III. </b>CHILDREN'S INFORMATION</label>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Anak</label>
                                    <select class="js-example-basic-multiple" name="id_resident[]" multiple="multiple">
                                        <?php foreach ($getResident as $row) : ?>
                                            <option value="<?= $row['id_resident'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <label><b>IV. </b>ADDRESS</label>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <select class="form-control js-states" style="width:100%;" id="id_household" name="id_household" required>
                                        <?php foreach ($getHousehold as $row2) : ?>
                                            <option value=""></option>
                                            <option value="<?= $row['id_household'] ?>"><?= $row2['purok_name'] . ', ' . $row2['household_address'] ?> </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <label><b>V. </b>EMERGENCY CONTACT</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pangalan</label>
                                        <input type="text" class="form-control" name="emergency_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kaugnayan</label>
                                        <input type="text" class="form-control" name="emergency_relationship">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="date" class="form-control" name="emergency_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cellphone (kung meron)</label>
                                        <input type="text" class="form-control" name="emergency_cp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Landline (kung meron)</label>
                                        <input type="text" class="form-control" name="emergency_landline">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        // START SELECT2
        $("#mother").select2({
            theme: "bootstrap4",
            placeholder: "Select Mother",
            allowClear: true,
            dropdownParent: $('#bodyadd')
        });

        $("#father").select2({
            theme: "bootstrap4",
            placeholder: "Select Father",
            allowClear: true,
            dropdownParent: $('#bodyadd')
        });

        $("#id_household").select2({
            theme: "bootstrap4",
            placeholder: "Select Household",
            allowClear: true,
            dropdownParent: $('#bodyadd')
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        // END SELECT2

        // Listen for changes in the select option
        $('#mother').on('change', function() {
            // Get the selected value
            var id = $(this).val();

            // Make an AJAX call to the PHP script
            $.ajax({
                url: 'get_resident_info.php',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    // Populate the input fields with the retrieved data
                    $('#birthdate').val(data.birthdate);
                    $('#phone').val(data.phone);
                    $('#occupation').val(data.occupation);
                }
            });
        });

        // add row
        // $("#addRow").click(function() {
        //     var html = '';
        //     html += '<div id="inputFormRow">';
        //     html += '<div class="row">';
        //     html += '<div class="col-md-6">';
        //     html += '<div class="form-group">';
        //     html += '<label>Anak</label>';
        //     html += '<select class="form-control js-states  " style="width:100%;" id="child" name="child" required>';
        //     html += '<?php foreach ($getResident as $row) : ?>';
        //     html += '<option value=""></option>';
        //     html += '<option value="<?= $row['id_resident'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?> </option>';
        //     html += '<?php endforeach ?>';
        //     html += '</select>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '<div class="col-md-6">';
        //     html += '<div class="form-group">';
        //     html += '<label>Birthday</label>';
        //     html += '<div class="input-group">';
        //     html += '<input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" disabled>';
        //     html += '<div class="input-group-prepend">';
        //     html += '<button class="btn btn-default btn-danger" type="button" id="removeRow">Remove</button>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '</div>';
        //     html += '</div>';

        //     $('#newRow').append(html);
        // });

        // remove row
        // $(document).on('click', '#removeRow', function() {
        //     $(this).closest('#inputFormRow').remove();
        // });

        var table = $('#pregnantwomen').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    </script>
</body>

</html>