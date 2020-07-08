<button title="Add service" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#serviceAddModal" title="Add new Service">
   <i class="fa fa-fw fa-plus"></i>
</button>
<div style="clear:both;"></div>
<ul class="list-group mt-2 provider-services-list alternate-grid">
    <?php 
     $provider = $user_detail->getCompany();
     $services = $provider->getServices();
    $class='';
    if($services && count($services)){
        $class='d-none';
        foreach($services as $service) {
            $this->load->view('myaccount/provider/partials/display-service', ['service' => $service]);
        }
    }
    ?>
    <li class="list-group-item not-found <?php echo $class;?>">No service found. Click "+" above to add.</li>
</ul>
<!-- Modals -->
<?php $this->load->view('myaccount/provider/modals/service-add', ['provider' => $provider]);?>
<?php $this->load->view('myaccount/provider/modals/service-edit', ['provider' => $provider]);?>