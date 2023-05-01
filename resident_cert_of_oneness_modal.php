<!-- Oneness Modal -->
<div class="modal fade" id="oneness<?= $row['id_resident'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fill Up</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="generate_cert_of_oneness.php">
                    <div class="form-group">
                        <label>Recipient's Name<span class="text-danger"><b> *</b></span></label>
                        <input type="text" class="form-control" placeholder="Enter recepients name" name="recipients_name" onkeypress="return onlyAlphabets(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Transaction details<span class="text-danger"><b> *</b></span></label>
                        <textarea class="form-control" onkeypress="return onlyAlphabets(event);" name="details" required>Certificate of Oneness for <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>First Name (Before)<span class="text-danger"><b> *</b></span></label>
                        <input type="text" class="form-control" placeholder="Enter first name" name="fname_before" onkeypress="return onlyAlphabets(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Middle Name (Before)<span class="text-danger"><b> *</b></span></label>
                        <input type="text" class="form-control" placeholder="Enter middle name" name="mname_before" onkeypress="return onlyAlphabets(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name (Before)<span class="text-danger"><b> *</b></span></label>
                        <input type="text" class="form-control" placeholder="Enter last name" name="lname_before" onkeypress="return onlyAlphabets(event)" required>
                    </div>
                    <div class="form-group">
                        <label>Purpose<span class="text-danger"><b> *</b></span></label>
                        <textarea class="form-control" onkeypress="return onlyAlphabets(event)" placeholder="E.g. who is a beneficiary of the Assistance for Individuals in Crisis Situation (AICS) of Sen. John Doe" name="purpose" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_resident" value="<?= $row['id_resident'] ?>">
                <button type="button" class="btn btn-secondary" data-dismiss='modal'>Close</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Next">
            </div>
            </form>
        </div>
    </div>
</div>