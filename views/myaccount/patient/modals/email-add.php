<div class="modal fade" id="contactEmailAddressAddModal" tabindex="-1" role="dialog" aria-labelledby="contactEmailAddressAddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactEmailAddressAddLabel">Add New Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(''); ?>
                <div class="alert alert-danger d-none" role="alert">An error occurred while processing your request. Please try again.</div>
                <input type="hidden" name="action" value="patient_contact_email_address_add" />
                <input type="hidden" name="contact_id" />
                <div class="form-group row">
                    <label for="email_address" class="col-sm-4 col-form-label">Email Address</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email_address" name="email_address" value="" required>
                        <div class="invalid-feedback">
                        Please provide correct email address.
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_contact_email_address_add">Add Email</button>
            </div>
        </div>
    </div>
</div>