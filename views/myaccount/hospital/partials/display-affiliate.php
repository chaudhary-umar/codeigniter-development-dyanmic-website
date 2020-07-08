<li class="list-group-item single-affiliate" data-id="<?php echo $affiliate->getId();?>" id="row-affiliate-<?php echo $affiliate->getId();?>">
    <div class="row">
    <div class="col-md-8"><?php echo $affiliate->getHospitalName();?></div>
    <div class="col-md-4 text-right">
        <div class="btn-group" role="group">
        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-for="affiliate" data-target="#deleteConfirmationModal" title="Delete"><i class="fa fa-fw fa-trash"></i></button>
        </div>
    </div>
    </div>
</li>