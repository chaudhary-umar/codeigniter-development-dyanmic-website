<div class="banner-section">
   <img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
   <div class="container">
      <h2>
         <?php echo $user_detail->getDisplayName();?>
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
               <li role="presentation"><a href="#services" aria-controls="home" role="tab" data-toggle="tab">Services</a></li>
               <li role="presentation"><a href="#contacts" aria-controls="home" role="tab" data-toggle="tab">Contacts</a></li>
               <li role="presentation"><a href="#globalconnect" aria-controls="home" role="tab" data-toggle="tab">Global Connect</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="profile">
                  <?php $this->load->view('myaccount/provider/profile');?>
               </div>
               <div role="tabpanel" class="tab-pane" id="services">
                  <?php $this->load->view('myaccount/provider/services');?>
               </div>
               <div role="tabpanel" class="tab-pane" id="contacts">
                  <?php $this->load->view('myaccount/provider/contacts');?>
               </div>
               <div role="tabpanel" class="tab-pane" id="globalconnect">
                  <?php $this->load->view('myaccount/provider/chat');?>
               </div>                
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('myaccount/provider/modals/delete-confirmation');?>