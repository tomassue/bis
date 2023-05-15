<!-- Edit Children modal -->
<div class="modal fade bd-example-modal-lg" id="editchildreninfo<?= $mother_profile['family_num'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Children</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="bodyadd">
                <form method="POST" action="model/edit_p_children_information.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to proceed?');">
                    <label><b>II. </b>CHILDREN'S INFORMATION</label>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Anak</label>
                            <select class="js-example-basic-multiple" name="id_resident[]" multiple="multiple">
                                <?php
                                $fm = $mother_profile['family_num'];
                                // $fetch_children = $conn->query("SELECT * FROM tbl_p_fam_members WHERE family_num='$fm' AND family_role='children'");
                                $sample = "SELECT * FROM tblresident2 LEFT JOIN tbl_p_fam_members ON tblresident2.id_resident = tbl_p_fam_members.id_resident WHERE tblresident2.id_resident IS NOT NULL";
                                $sam = $conn->query($sample);
                                ?>
                                <?php if ($sam == TRUE) : ?>
                                    <?php foreach ($sam as $row) : ?>
                                        <?php if ($fm == $row['family_num'] && $row['family_role'] != "father" && $row['family_role'] != "mother") : ?>
                                            <option value="<?= $row['id_resident'] ?>" selected><?= $row['firstname'] . ' ' . $row['lastname'] ?></option>
                                        <?php elseif ($row['family_role'] != "father" && $row['family_role'] != "mother") : ?>
                                            <option value="<?= $row['id_resident'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
            </div>
            <div>
                <div class="modal-footer">
                    <input type="hidden" value="children" name="family_role">
                    <input type="hidden" value="<?= $mother_profile['family_num'] ?>" name="family_num">
                    <input type="hidden" value="<?= $id ?>" name="mother_id">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>