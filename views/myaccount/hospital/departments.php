<?php $hospital = $user_detail->getHospital();?>
<button title="Add department to the hospital" class="btn btn-primary btn-sm pull-right edit" data-toggle="modal" data-target="#departmentAttachModal" data-for="departments">
   <i class="fa fa-fw fa-plus"></i>
</button>
<div style="clear:both; height:20px;"></div>
<ul class="list-group mt-2 departments-list">
    <?php 
    $departments = $hospital->getDepartments();
    $class='';
    if($departments && count($departments)){
        $class='d-none';
        foreach($departments as $department) {
            $this->load->view('myaccount/hospital/partials/display-department', ['department' => $department, 'hospital'=>$hospital]);
        }
    }
    ?>
    <li class="list-group-item not-found <?php echo $class;?>">No departmant found. Click "+" above to add.</li>
</ul>
<!-- Modals -->
<?php $this->load->view('myaccount/hospital/modals/department-add', ['hospital' => $hospital]);?>
<?php $this->load->view('myaccount/hospital/modals/service-add', ['hospital' => $hospital]);?>
<?php $this->load->view('myaccount/hospital/modals/service-edit');?>
<?php $this->load->view('myaccount/hospital/modals/contact-add');?>
<?php $this->load->view('myaccount/hospital/modals/contact-edit');?>
<?php $this->load->view('myaccount/hospital/modals/address-add');?>
<?php $this->load->view('myaccount/hospital/modals/address-edit');?>
<?php $this->load->view('myaccount/hospital/modals/phone-edit');?>
<?php $this->load->view('myaccount/hospital/modals/phone-add');?>
<?php $this->load->view('myaccount/hospital/modals/email-add');?>
<?php $this->load->view('myaccount/hospital/modals/email-edit');?>