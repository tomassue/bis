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
                                    <option value="Hon.">Hon.</option>
                                    <option value="Ms.">Ms.</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <small id="housenumHelp" class="form-text text-muted"><b>Ex. </b>John J. Doe</small>
                                <input type="text" class="form-control" placeholder="Enter Fullname" id="name" name="name" required>
                            </div>
                        </div>
                        <!-- <input type="text" class="form-control" id="name" placeholder="Enter Fullname" name="name" required> -->
                    </div>
                    <div class="form-group">
                        <label>Chairmanship<span class="text-danger"><b> *</b></span></label>
                        <div class="overflow-auto" style="max-height: 300px; margin-bottom: 10px; overflow:scroll; -webkit-overflow-scrolling: touch;">
                            <div class="selectgroup selectgroup-pills">
                                <?= $row['id_officials'] ?>
                                <?php foreach ($chair as $row) : ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="chairmanship[]" value="<?= $row['id_chairmanship'] ?>" class="selectgroup-input">
                                        <span class="selectgroup-button"><?= $row['title'] ?></span>
                                    </label>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <select class="form-control" id="position" required name="position">
                            <option disabled selected>Select Official Position</option>
                            <?php foreach ($position as $row) : ?>
                                <option value="<?= $row['id_position'] ?>">Brgy. <?= $row['position'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Term Start</label>
                        <input type="date" class="form-control" id="start" name="start" required>
                    </div>
                    <div class="form-group">
                        <label>Term End</label>
                        <input type="date" class="form-control" id="end" name="end" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="status" required name="status">
                            <option value="Incumbent">Incumbent</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="text" id="off_id" name="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>