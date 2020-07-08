<?php 
    if($serviceProviders && count($serviceProviders)){
        foreach($serviceProviders as $serviceProvider) {
            $this->load->view('search/partials/display-service-provider', ['serviceProvider' => $serviceProvider]);
        }
    } else {
        ?>
   
        No Result found.
    
<?php } ?>
