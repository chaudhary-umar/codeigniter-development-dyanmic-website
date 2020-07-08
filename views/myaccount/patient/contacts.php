<button class="btn btn-primary btn-sm pull-right" title="Add new contact" data-toggle="modal" data-target="#contactAddModal">
   <i class="fa fa-fw fa-user-plus"></i>
</button>
<div style="clear:both; height:20px;"></div>
<ul class="list-group mt-2 patient-contacts-list">
    <?php 
    $contacts = $user_detail->getContacts();
    $class='';
    if($contacts && count($contacts)){
        $class='d-none';
        foreach($contacts as $contact) {
            $this->load->view('myaccount/patient/partials/display-contact', ['contact' => $contact]);
        }
    }
    
    ?>
    <li class="list-group-item not-found <?php echo $class;?>">No contact found. Click "+" above to add.</li>
</ul>
<!-- Modals -->
<?php $this->load->view('myaccount/patient/modals/address-add');?>
<?php $this->load->view('myaccount/patient/modals/address-edit');?>
<?php $this->load->view('myaccount/patient/modals/contact-add');?>
<?php $this->load->view('myaccount/patient/modals/contact-edit');?>
<?php $this->load->view('myaccount/patient/modals/email-add');?>
<?php $this->load->view('myaccount/patient/modals/email-edit');?>
<?php $this->load->view('myaccount/patient/modals/phone-add');?>
<?php $this->load->view('myaccount/patient/modals/phone-edit');?>
<?php $this->load->view('myaccount/patient/modals/delete-confirmation');?>