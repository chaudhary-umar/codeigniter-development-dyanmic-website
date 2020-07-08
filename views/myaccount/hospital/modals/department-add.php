<div class="modal fade" id="departmentAttachModal" tabindex="-1" role="dialog" aria-labelledby="departmentAttachModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="departmentAttachModalLabel">Attach Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(''); ?>
                <div class="alert alert-danger d-none" role="alert">An error occurred while processing your request. Please try again.</div>
                <input type="hidden" name="action" value="hospital_department_attach" />
                <input type="hidden" name="hospital_id" />
                <div class="form-group row">
                    <label for="department_id" class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-9">
                        <select name="department_id" class="form-control"></select>
                        <div class="invalid-feedback">
                        Please provide department name
                        </div>
                    </div>
                </div>
                <div class="form-group row d-none" id="new_department">
                    <label for="department_name" class="col-sm-3 col-form-label">Department Name</label>
                    <div class="col-sm-9">
                        <input name="department_name" class="form-control">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_hospital_department_attach">Attach Department</button>
            </div>
        </div>
    </div>
</div>