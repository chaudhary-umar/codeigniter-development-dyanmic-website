<li class="list-group-item single-service" style="border:none;" data-id="<?php echo $service->getId();?>" id="row-service-<?php echo $service->getId();?>">
    <div class="row pr-3">
        <div class="col-md-4 mt-2"><?php echo $service->getServiceName();?></div>
        <div class="col-md-3 mt-2"><?php echo $service->getCategory();?></div>
        <div class="col-md-3 mt-2"><?php echo $service->getSubCategory();?></div>
        <div class="col-md-2 pr-0 text-right" style="padding-right:0">
            <div class="btn-group pt-1" role="group">
                <button type="button" class="btn btn-secondary btn-sm edit" data-for="service" title="Edit Details"><i class="fa fa-fw fa-edit"></i></button>
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-for="service" data-target="#deleteConfirmationModal" title="Delete"><i class="fa fa-fw fa-trash"></i></button>
            </div>
        </div>
    </div>
</li>