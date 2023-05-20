<!-- Edit Kasalukuyan at Nakaraang Kondisyon habang nagbubuntis modal -->
<div class="modal fade bd-example-modal-lg" id="edithcpc<?= $gethcpc['id_mother_h_c_pregnancy_condition'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="bodyadd">
                <form method="POST" action="model/save_hcpc.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                    <label>Nanay, sagutin ang mga sumusunod sa tulong ng iyong doktor, nars, o midwife.</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Petsa ng unang check-up: </label>
                                <input type="date" class="form-control" value="<?= $gethcpc['first_check_up_date'] ?>" name="first_check_up_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Edad (Age): </label>
                                <?php
                                $bdate = $mother_profile['birthdate'];
                                $dob = new DateTime($bdate);
                                $now = new DateTime();
                                $diff = $now->diff($dob);
                                ?>
                                <input type="text" class="form-control" value="<?= $diff->y . ' ' . 'years old' ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Timbang (Weight):</label>
                                <!-- <input type="text" class="form-control" name="p_weight"> -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="p_weight" value="<?= rtrim($gethcpc['p_weight'], ".0") ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2" name="p_weight">kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Taas (Height): </label>
                                <!-- <input type="text" class="form-control" name="p_height"> -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="p_height" value="<?= rtrim($gethcpc['p_height'], ".0") ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon3">cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-inline-block text-truncate" style="max-width: 100%;" title="Kalagayan ng Kalusugan (Nutritional status based on Body Mass Index)">Kalagayan ng Kalusugan (Nutritional status based on Body Mass Index): </label>
                                <input type="text" class="form-control" name="health_condition" placeholder="BMI" value="<?= rtrim($gethcpc['health_condition'], ".0") ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-inline-block text-truncate" style="max-width: 100%;">Petsa ng huling regla (Date of last menstrual period): </label>
                                <input type="date" class="form-control" name="last_mens_period_date" value="<?= $gethcpc['last_mens_period_date'] ?>" id="last_mens_period" onchange="calculateExpectedDeliveryDate()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-inline-block text-truncate" style="max-width: 100%;">Kailan ako manganganak (Expected date of delivery): </label>
                                <input type="date" class="form-control" name="expected_date_delivery" value="<?= $gethcpc['expected_date_delivery'] ?>" id="expected_date_delivery">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-inline-block text-truncate" style="max-width: 100%;">No. of Pregnancy</label>
                                <input type="number" class="form-control" name=""> <!-- The output for this will be based on her children. -->
                            </div>
                        </div>
                    </div>
            </div>
            <div>
                <div class="modal-footer">
                    <input type="hidden" value="<?= $id ?>" name="mother_id">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>