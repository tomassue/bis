<!-- Edit Immunization Record modal -->
<div class="modal fade bd-example-modal-lg" id="editimmunization<?= $row['id_immunization_record'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Immunization Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/save_immunization_record.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tetanus-containing Vaccine</label>
                                <select class="form-control js-states immunizationSelect" style="width:100%" id="<?= $selectId ?>" name="tcv">
                                    <?php foreach ($tetanusVac as $row2) : ?>
                                        <option value=""></option>
                                        <option value="<?= $row2['tetanus_containing_vaccine'] ?>" <?php if ($row2['tetanus_containing_vaccine'] == $row['tetanus_containing_vaccine']) {
                                                                                                        echo 'selected="selected"';
                                                                                                    } ?>><?= $row2['tetanus_containing_vaccine_detail'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date Given</label>
                                <input type="date" class="form-control" name="date_given" value="<?= $row['date_given'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>When to Return</label>
                                <input type="date" class="form-control" name="when_to_return" value="<?= $row['when_to_return'] ?>">
                            </div>
                        </div>
                    </div>
            </div>
            <div>
                <div class=" modal-footer">
                    <input type="hidden" value="<?= $id ?>" name="mother_id">
                    <input type="hidden" value="<?= $hcpc_id ?>" name="hcpc_id">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>