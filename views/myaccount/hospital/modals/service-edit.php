<div class="modal fade" id="serviceUpdateModal" tabindex="-1" role="dialog" aria-labelledby="serviceUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceUpdateModalLabel">Update Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(''); ?>
                <div class="alert alert-danger d-none" role="alert">An error occurred while processing your request. Please try again.</div>
                <input type="hidden" name="action" value="hospital_service_update" />
                <input type="hidden" name="hospital_id" />
                <input type="hidden" name="department_id" />
                <input type="hidden" name="hs_id" />
                <div class="form-group row">
                    <label for="service_name" class="col-sm-3 col-form-label">Service</label>
                    <div class="col-sm-9 service_name" style="padding-left:30px; padding-top:10px"></div>
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
                <button type="button" class="btn btn-primary" id="btn_hospital_service_update">Update Service</button>
            </div>
        </div>
    </div>
</div>