<div class="modal fade" id="serviceUpdateModal" tabindex="-1" role="dialog" aria-labelledby="serviceUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLabel">Update Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(''); ?>
                <div class="alert alert-danger d-none" role="alert">An error occurred while processing your request. Please try again.</div>
                <input type="hidden" name="action" value="provider_service_update" />
                <input type="hidden" name="provider_id" value="<?php echo $provider->getId();?>" />
                <input type="hidden" name="service_id" />
                <div class="form-group row">
                    <label for="service_name" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="service_name" name="service_name" value="" required>
                        <div class="invalid-feedback">Service Name is required.</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_category" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="service_category" name="service_category" value="" required>
                        <div class="invalid-feedback">Service category is required.</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_sub_category" class="col-sm-4 col-form-label">Sub category</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="service_sub_category" name="service_sub_category" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="min_price" class="col-sm-4 col-form-label">Min Price</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="min_price" name="min_price" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="max_price" class="col-sm-4 col-form-label">Max Price</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="max_price" name="max_price" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="comments" class="col-sm-4 col-form-label">Comments</label>
                    <div class="col-sm-8">
                        <textarea type="text" class="form-control" id="comments" name="comments" maxlength="1000"></textarea>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_provider_service_update">Update Service</button>
            </div>
        </div>
    </div>
</div>