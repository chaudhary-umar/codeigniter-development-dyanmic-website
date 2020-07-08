<div class="modal fade" id="contactPhoneNumberAddModal" tabindex="-1" role="dialog" aria-labelledby="contactPhoneNumberAddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactPhoneNumberAddModalLabel">Add New Phone Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(''); ?>
                <div class="alert alert-danger d-none" role="alert">An error occurred while processing your request. Please try again.</div>
                <input type="hidden" name="action" value="patient_contact_phone_number_add" />
                <input type="hidden" name="contact_id" />
                <div class="form-group row">
                    <label for="phone_number" class="col-sm-4 col-form-label pr-1">Phone Number</label>
                    <div class="col-sm-8 pl-0">
                        <div class="input-group input-group-sm" style="display:flex;">
                            <span class="pt-1 pl-1 pr-1">+</span>
                            <input type="tel" class="form-control col-5" name="ctry_cd" pattern="[0-9]{1,}" maxlength="3" size="3" required="" style="width: 14%;">
                            <span class="pt-1 pl-1 pr-1">(</span>
                            <input type="tel" class="form-control" name="area_cd" pattern="[0-9]{3}" maxlength="3" size="3" required="" style="width: 14%;">
                            <span class="pt-1 pl-1 pr-1">)</span>
                            <input type="tel" class="form-control" name="phone_no" pattern="[0-9]{7}" maxlength="7" size="7" required="" style="width: 40%;">
                            <span class="pt-1 pl-1 pr-1">ext</span>
                            <input type="tel" class="form-control" name="ext" pattern="[0-9]{0,}" maxlength="4" size="4" style="width: 14%;">
                        </div>
                        <small id="phoneNumberHelp" class="form-text text-muted">Enter phone number in +1 (111) 111 1111 format</small>
                        <div class="invalid-feedback">
                            Please provide correct phone number.
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_contact_phone_number_add">Add Phone Number</button>
            </div>
        </div>
    </div>
</div>