<div class="banner-section">
   <img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
   <div class="container">
      <h2>
         <?php echo $user_detail->getDisplayName();?>
         <input type="hidden" id="hospital_id" value="<?php echo $user_detail->getHospital()->getId();?>" />
      </h2>
   </div>
</div>
<div class="searc-wrap">
   <div class="container">
      <div class="search-tab">
         <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"><a href="#profile" aria-controls="home" role="tab" data-toggle="tab">Profile</a></li>
               <li role="presentation"><a href="#departments" aria-controls="home" role="tab" data-toggle="tab">Departments</a></li>
               <li role="presentation"><a href="#affiliates" aria-controls="home" role="tab" data-toggle="tab">Affiliates</a></li>
               <li role="presentation"><a href="#globalconnect" aria-controls="home" role="tab" data-toggle="tab">Global Connect</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="profile">
                  <?php $this->load->view('myaccount/hospital/profile');?>
               </div>
               <div role="tabpanel" class="tab-pane" id="departments">
                  <?php $this->load->view('myaccount/hospital/departments');?>
               </div>
               <div role="tabpanel" class="tab-pane" id="affiliates">
                  <?php $this->load->view('myaccount/hospital/affiliates');?>
               </div>
               <div role="tabpanel" class="tab-pane" id="globalconnect">
                  <?php $this->load->view('myaccount/hospital/chat');?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('myaccount/hospital/modals/delete-confirmation');?>
<?php $this->load->view('common/operation-failure-alert');?>