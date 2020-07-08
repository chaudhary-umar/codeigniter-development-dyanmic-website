<div class="single-service row" data-service-id="<?php echo $service->getservice()->getId();?>" data-id="<?php echo $service->getId();?>" id="row-service-<?php echo $service->getId();?>" style="margin-top:2px;">
    <div class="col-md-3 pr-0"><?php echo $service->getService()->getServiceName();?></div>
    <div class="col-md-2 pr-0"><?php echo $service->getMinPrice();?></div>
    <div class="col-md-2 pr-0"><?php echo $service->getMaxPrice();?></div>
    <div class="col-md-3 pr-0"><?php echo $service->getComments();?></div>
    <div class="col-md-2 text-right">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary btn-sm edit" data-for="service" title="Edit Details"><i class="fa fa-fw fa-edit"></i></button>
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-for="service" data-target="#deleteConfirmationModal" title="Delete"><i class="fa fa-fw fa-trash"></i></button>
        </div>
    </div>
</div>