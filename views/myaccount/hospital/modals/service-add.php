<div class="modal fade" id="serviceAttachModal" tabindex="-1" role="dialog" aria-labelledby="serviceAttachModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceAttachModalLabel">Attach Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(''); ?>
                <div class="alert alert-danger d-none" role="alert">An error occurred while processing your request. Please try again.</div>
                <input type="hidden" name="action" value="hospital_service_attach" />
                <input type="hidden" name="hospital_id" />
                <input type="hidden" name="department_id" />
                <div class="form-group row">
                    <label for="service_id" class="col-sm-3 col-form-label">Service</label>
                    <div class="col-sm-9">
                        <select name="service_id" class="form-control"></select>
                        <div class="invalid-feedback">
                        Please provide service provider name
                        </div>
                    </div>
                </div>
                <div class="d-none" id="new_service">
                <div class="form-group row">
                    <label for="service_name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="service_name" name="service_name" value="">
                        <div class="invalid-feedback">Service Name is required.</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_category" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="service_category" name="service_category" value="">
                        <div class="invalid-feedback">Service category is required.</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_sub_category" class="col-sm-3 col-form-label">Sub category</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="service_sub_category" name="service_sub_category" value="">
                    </div>
                </div>
                </div>
                
                <div class="form-group row">
                    <label for="min_price" class="col-sm-3 col-form-label">Min Price</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="min_price" name="min_price" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="max_price" class="col-sm-3 col-form-label">Max Price</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="max_price" name="max_price" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="comments" class="col-sm-3 col-form-label">Comments</label>
                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" id="comments" name="comments" maxlength="1000"></textarea>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_hospital_service_attach">Attach Service</button>
            </div>
        </div>
    </div>
</div>