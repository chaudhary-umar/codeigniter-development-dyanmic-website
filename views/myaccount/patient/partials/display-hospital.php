<div class="col-md-12 col-sm-6 col-md-4 single-item">
    <div class="card mt-2">
        <div class="card-header p-2">
            <div class="row">
                <div class="col-md-10">
                    <span class="h4"><?php echo $hospital->getHospitalName();?></span>
                </div>
                <div class="col-md-2 text-right">
                <i class="fa fa-heart text-danger icon-favorite pb-2" data-type="hospital" data-id="<?php echo $hospital->getId();?>"></i>
                </div>
            </div>
        </div>
        <!--div class="card-body">
            <?php echo $hospital->getHospitalName();?><br />
            <a href="<?php $hospital->getHospitalUrl();?>" target="_blank"><?php $hospital->getHospitalUrl();?></a>
        </div-->
    </div>
</div>