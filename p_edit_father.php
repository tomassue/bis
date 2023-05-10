<!-- Edit Father modal -->
<div class="modal fade bd-example-modal-lg" id="editfatherinfo<?= $father_info['id_resident'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Father</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="bodyedit">
                <form method="POST" action="model/edit_p_father_information.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                    <label><b>I. </b>FATHER'S INFORMATION</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Father</label>
                                <select class="form-control js-states" style="width:100%;" id="editfather" name="id_resident" required>
                                    <?php foreach ($getResident as $row) : ?>
                                        <option value=""></option>
                                        <option value="<?= $row['id_resident'] ?>" <?php if ($father_info['id_resident'] == $row['id_resident']) {
                                                                                        echo 'selected = "selected"';
                                                                                    } ?>><?= $row['firstname'] . ' ' . $row['lastname'] ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="text" class="form-control" id="f_birthdate" value="<?= $father_info['birthdate'] ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cellphone (kung meron)</label>
                                <input type="text" class="form-control" id="f_phone" value="<?= $father_info['phone'] ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <input type="text" class="form-control" name="blood_type" value="<?= $father_info['family_blood_type'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Trabaho</label>
                                <input type="text" class="form-control" id="f_occupation" value="<?= $father_info['occupation'] ?>" disabled>
                            </div>
                        </div>
                    </div>
            </div>
            <div>
                <div class="modal-footer">
                    <input type="hidden" value="father" name="family_role">
                    <input type="hidden" value="<?= $father_info['family_num'] ?>" name="family_num">
                    <input type="hidden" value="<?= $id ?>" name="mother_id">
                    <input type="hidden" value="<?= $father_info['id_resident'] ?>" name="father_id">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>