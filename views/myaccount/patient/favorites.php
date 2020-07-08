<?php echo form_open('', ['id' => 'frm_patient_favorites']); ?>
<div class="row">
<?php 
    $notFoundCls = ' d-none';
    $favorites = $user_detail->getFavorites();
    if($favorites && count($favorites)){
        foreach($favorites as $favorite) {
            if($favorite->getType() == 'hospital'){
                $hospital = $this->doctrine->em->find('GptHospital', $favorite->getReferenceId());
                $this->load->view('myaccount/patient/partials/display-hospital', ['hospital' => $hospital]);
            }else if($favorite->getType() == 'service_provider'){
                $serviceProvider = $this->doctrine->em->find('GptCompany', $favorite->getReferenceId());
                $this->load->view('myaccount/patient/partials/display-service-provider', ['serviceProvider' => $serviceProvider]);
            }
        }
    } else {
        $notFoundCls = '';
    }
?>
<div class="col-12 not-found<?php echo $notFoundCls;?>">
        You do not have any hospital / service provider saved.
    </div>
</div>
<?php echo form_close(); ?>

<style>
.d-none {
    display: none!important;
}
</style>