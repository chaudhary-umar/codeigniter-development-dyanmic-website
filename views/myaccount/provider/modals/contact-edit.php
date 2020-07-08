<div class="modal fade" id="contactUpdateModal" tabindex="-1" role="dialog" aria-labelledby="contactUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">Update Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(''); ?>
                <div class="alert alert-danger d-none" role="alert">An error occurred while processing your request. Please try again.</div>
                <input type="hidden" name="action" value="provider_contact_update" />
                <input type="hidden" name="provider_id" value="<?php echo $provider->getId();?>" />
                <input type="hidden" name="contact_id" />
                <div class="form-group row">
                    <label for="salutation" class="col-sm-4 col-form-label">Salutation</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="salutation" id="salutation">
                            <?php foreach ($salutations as $salutation):?>
                            <option value="<?php echo $salutation;?>"><?php echo $salutation;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="" required>
                        <div class="invalid-feedback">
                        Please provide first name
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="middle_name" class="col-sm-4 col-form-label">Middle Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="" required>
                        <div class="invalid-feedback">
                        Please provide last name
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="job_title" class="col-sm-4 col-form-label">Job Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="job_title" name="job_title" value="" required>
                        <div class="invalid-feedback">
                        Please provide job title
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="job_function" class="col-sm-4 col-form-label">Job Function</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="job_function" name="job_function" value="" required>
                        <div class="invalid-feedback">
                        Please provide job function
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="job_role" class="col-sm-4 col-form-label">Job Role</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="job_role" name="job_role" value="" required>
                        <div class="invalid-feedback">
                        Please provide job role
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_contact_update">Update Contact</button>
            </div>
        </div>
    </div>
</div>