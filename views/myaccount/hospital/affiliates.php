<?php $hospital = $user_detail->getHospital();?>
<button title="Add other hospital as affiliate" class="btn btn-primary btn-sm pull-right edit" data-toggle="modal" data-target="#affiliateAttachModal" data-for="affiliates">
   <i class="fa fa-fw fa-plus"></i>
</button>
<div style="clear:both; height:20px;"></div>
<ul class="list-group mt-2 affiliates-list">
    <?php 
    $affiliates = $hospital->getAffiliates();
    $class='';
    if($affiliates && count($affiliates)){
        $class='d-none';
        foreach($affiliates as $affiliate) {
            $this->load->view('myaccount/hospital/partials/display-affiliate', ['affiliate' => $affiliate]);
        }
    }
    ?>
    <li class="list-group-item not-found <?php echo $class;?>">No affiliate found. Click "+" above to attach.</li>
</ul>
<!-- Modals -->
<?php $this->load->view('myaccount/hospital/modals/affiliate-add', ['hospital' => $hospital]);?>