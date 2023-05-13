<!-- Edit Emergency contact modal -->
<div class="modal fade bd-example-modal-lg" id="editemergencycontactinfo<?= $emergency_contact_info['id_p_emergency_contact'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Emergency contat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="bodyadd">
                <form method="POST" action="model/edit_p_emergency_contact_information.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                    <label><b>III. </b>EMERGENCY CONTACT</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pangalan</label>
                                <input type="text" class="form-control" name="emergency_name" value="<?= $emergency_contact_info['emergency_name'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kaugnayan</label>
                                <input type="text" class="form-control" name="emergency_relationship" value="<?= $emergency_contact_info['emergency_relationship'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="date" class="form-control" name="emergency_date" value="<?= $emergency_contact_info['emergency_bday'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cellphone (kung meron)</label>
                                <input type="text" class="form-control" name="emergency_cp" value="<?= $emergency_contact_info['emergency_cellphone'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Landline (kung meron)</label>
                                <input type="text" class="form-control" name="emergency_landline" value="<?= $emergency_contact_info['emergency_landline'] ?>">
                            </div>
                        </div>
                    </div>
            </div>
            <div>
                <div class="modal-footer">
                    <input type="hidden" value="<?= $mother_profile['family_num'] ?>" name="family_num">
                    <input type="hidden" value="<?= $emergency_contact_info['id_p_emergency_contact'] ?>" name="em_id">
                    <input type="hidden" value="<?= $id ?>" name="mother_id">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>