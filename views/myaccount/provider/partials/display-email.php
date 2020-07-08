<div class="row pb-2 single-email" data-id="<?php echo $email->getId();?>" id="row-email-<?php echo $email->getId();?>" style="padding: .5em 0;">
    <div class="col-md-8 pr-0"><?php echo $email;?></div>
    <div class="col-md-4 text-right">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary btn-sm edit" data-for="email" title="Edit Details"><i class="fa fa-fw fa-edit"></i></button>
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deleteConfirmationModal" data-for="email" title="Delete"><i class="fa fa-fw fa-trash"></i></button>
        </div>
    </div>
</div>