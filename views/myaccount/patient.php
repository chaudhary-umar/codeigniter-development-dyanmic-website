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

               <li role="presentation"><a href="#contacts" aria-controls="profile" role="tab" data-toggle="tab">Contacts</a></li>

               <li role="presentation"><a href="#favorites" aria-controls="profile" role="tab" data-toggle="tab">Favorites</a></li>

               <li role="presentation"><a href="#my-health" aria-controls="profile" role="tab" data-toggle="tab">My

                     Health</a></li>

            </ul>

            <!-- Tab panes -->

            <div class="tab-content">

               <div role="tabpanel" class="tab-pane active" id="profile">

                  <?php $this->load->view('myaccount/patient/profile');?>

               </div>

               <div role="tabpanel" class="tab-pane" id="contacts">

                  <?php $this->load->view('myaccount/patient/contacts');?>

               </div>

               <div role="tabpanel" class="tab-pane" id="favorites">

                  <?php $this->load->view('myaccount/patient/favorites');?>

               </div>

               <div role="tabpanel" class="tab-pane" id="my-health">

                  <?php $this->load->view('myaccount/patient/health');?>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>