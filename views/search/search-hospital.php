
<?php 
    if($hospitals && count($hospitals)){
        foreach($hospitals as $hospital) {
            $this->load->view('search/partials/display-hospital', ['hospital' => $hospital]);
        }
    } else {
        ?>
   
        No Result found.
   
<?php } ?>
