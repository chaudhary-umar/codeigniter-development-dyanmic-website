<div class="row pb-2 single-phone" data-id="<?php echo $phone_number->getId();?>" id="row-phone-<?php echo $phone_number->getId();?>" style="padding: .5em 0;">
    <div class="col-md-8 pr-0"><?php echo $phone_number;?></div>
    <div class="col-md-4 text-right">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary btn-sm edit" data-for="phone" title="Edit Details"><i class="fa fa-fw fa-edit"></i></button>
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-for="phone" data-target="#deleteConfirmationModal" title="Delete"><i class="fa fa-fw fa-trash"></i></button>
        </div>
    </div>
</div>