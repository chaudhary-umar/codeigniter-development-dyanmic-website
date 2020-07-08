<div class="col-md-12 col-sm-6 col-md-4 single-item">
    <div class="card mt-2">
        <div class="card-header p-2">
            <div class="row">
                <div class="col-md-10">
                    <span class="h4"><?php echo $serviceProvider->getCompanyName();?></span>
                </div>
                <div class="col-md-2 text-right">
                    <i class="fa fa-heart text-danger icon-favorite pb-2" data-type="service_provider" data-id="<?php echo $serviceProvider->getId();?>"></i>
                </div>
            </div>
        </div>
        <!--div class="card-body">
            <?php echo $serviceProvider->getCompanyName();?><br />
            <a href="<?php $serviceProvider->getCompanyUrl();?>" target="_blank"><?php $serviceProvider->getCompanyUrl();?></a>
        </div-->
    </div>
</div>