<!-- Appearance Modal -->
<div class="modal fade" id="cert_appearance<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Certificate of Appearance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="generate_cert_appearance.php">
                    <div class="form-group">
                        <label>Recipient's Name</label>
                        <input type="text" class="form-control" placeholder="Enter recepients name" name="recipients_name" onkeypress="return onlyAlphabets(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Transaction details<span class="text-danger"><b> *</b></span></label>
                        <textarea class="form-control" onkeypress="return onlyAlphabets(event);" name="details" required>Certificate of Appearance for <?= ucwords($row['name']) ?></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_cert_appearance" value="<?= $row['id_cert_appearance'] ?>">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Next">
            </div>
            </form>
        </div>
    </div>
</div>