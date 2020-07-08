<button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#contactAddModal" title="Add new Contact">
   <i class="fa fa-fw fa-user-plus"></i>
</button>
<div style="clear:both; padding-bottom:20px;"></div>
<ul class="list-group mt-2 provider-contacts-list">
    <?php 
    $provider = $user_detail->getCompany();
    $contacts = $provider->getContacts();
    $class='';
    if($contacts && count($contacts)){
        $class='d-none';
        foreach($contacts as $contact) {
            $this->load->view('myaccount/provider/partials/display-contact', ['contact' => $contact, 'provider' => $provider]);
        }
    }
    
    ?>
    <li class="list-group-item not-found <?php echo $class;?>">No contact found. Click "+" above to add.</li>
</ul>
<!-- Modals -->
<?php $this->load->view('myaccount/provider/modals/address-add', ['provider' => $provider]);?>
<?php $this->load->view('myaccount/provider/modals/address-edit', ['provider' => $provider]);?>
<?php $this->load->view('myaccount/provider/modals/contact-add', ['provider' => $provider]);?>
<?php $this->load->view('myaccount/provider/modals/contact-edit', ['provider' => $provider]);?>
<?php $this->load->view('myaccount/provider/modals/email-add', ['provider' => $provider]);?>
<?php $this->load->view('myaccount/provider/modals/email-edit', ['provider' => $provider]);?>
<?php $this->load->view('myaccount/provider/modals/phone-add', ['provider' => $provider]);?>
<?php $this->load->view('myaccount/provider/modals/phone-edit', ['provider' => $provider]);?>