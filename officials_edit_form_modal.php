<!-- Modal -->
<div class="modal fade" id="edit<?= $row['id_officials'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Official</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_official.php">
                    <div class="form-group">
                        <label>Fullname</label>
                        <div class="row">
                            <div class="col-md-4">
                                <small id="housenumHelp" class="form-text text-muted"><b>Ex. </b>Hon. or Ms.</small>
                                <select class="form-control" id="honorifics" name="honorifics" required>
                                    <option value="Hon." <?php if ($row['honorifics'] == 'Hon.') {
                                                                echo 'selected = "selected"';
                                                            } ?>>Hon.</option>
                                    <option value="Ms." <?php if ($row['honorifics'] == 'Ms.') {
                                                            echo 'selected = "selected"';
                                                        } ?>>Ms.</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <small id="housenumHelp" class="form-text text-muted"><b>Ex. </b>John J. Doe</small>
                                <input type="text" class="form-control" placeholder="Enter Fullname" id="name" name="name" value="<?= $row['name'] ?>" required>
                            </div>
                        </div>
                        <!-- <input type="text" class="form-control" id="name" placeholder="Enter Fullname" name="name" required> -->
                    </div>
                    <div class="form-group">
                        <label>Chairmanship<span class="text-danger"><b> *</b></span></label>
                        <div class="overflow-auto" style="max-height: 300px; margin-bottom: 10px; overflow:scroll; -webkit-overflow-scrolling: touch;">
                            <div class="selectgroup selectgroup-pills">
                                <?php
                                $id_official = $row['id_officials'];
                                $fetch_chairmanship = $conn->query("SELECT * FROM tblchairmanship");
                                ?>
                                <?php while ($fc = $fetch_chairmanship->fetch_assoc()) : ?>
                                    <?php
                                    $id_chairmanship = $fc['id_chairmanship'];
                                    $query_get_chair = $conn->query("SELECT * FROM tblofficials_chairmanships WHERE id_officials = '$id_official' AND id_chairmanship = '$id_chairmanship'");
                                    ?>
                                    <?php if ($query_get_chair->num_rows > 0) : ?>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="chairmanship[]" value="<?= $fc['id_chairmanship'] ?>" class="selectgroup-input" checked>
                                            <span class="selectgroup-button"><?= $fc['title'] ?></span>
                                        </label>
                                    <?php else : ?>
                                        <label class="selectgroup-item">
                                            <input type="checkbox" name="chairmanship[]" value="<?= $fc['id_chairmanship'] ?>" class="selectgroup-input">
                                            <span class="selectgroup-button"><?= $fc['title'] ?></span>
                                        </label>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php
                        $query_select_position = "SELECT * FROM tblofficials WHERE `id_officials` = '$id_official'";
                        $result_select_position = $conn->query($query_select_position);
                        $official_id = $result_select_position->fetch_assoc();
                        ?>
                        <label>Position</label>
                        <select class="form-control" id="position" required name="position">
                            <option disabled selected>Select Official Position</option>
                            <?php foreach ($position as $pos_row) : ?>
                                <option value="<?= $pos_row['id_position'] ?>" <?php if ($official_id['id_position'] == $pos_row['id_position']) {
                                                                                    echo 'selected = "selected"';
                                                                                } ?>><?= $pos_row['position'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Term Start</label>
                        <input type="date" class="form-control" id="start" name="start" value="<?= $row['termstart'] ?>" required>
                    </div>
                    <div class=" form-group">
                        <label>Term End</label>
                        <input type="date" class="form-control" id="end" name="end" value="<?= $row['termend'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="status" required name="status">
                            <option value="Incumbent" <?php if ($row['status'] == 'Incumbent') {
                                                            echo 'selected = "selected"';
                                                        } ?>>Incumbent</option>
                            <option value="Inactive" <?php if ($row['status'] == 'Inactive') {
                                                            echo 'selected = "selected"';
                                                        } ?>>Inactive</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="off_id" name="id" value="<?= $row['id_officials'] ?>">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>