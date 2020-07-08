      <div class="slider-section wow fadeInDown" data-wow-delay="0.2s">
         <div class="container-fluid">
            <div class="row">
               <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                     <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                     <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                     <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                  </ol>
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                     <div class="item active">
                        <img src="<?php echo $base_url; ?>assets/global/img/slider-1.jpg" alt="..."  class="img-responsive">
                     </div>
                     <div class="item">
                        <img src="<?php echo $base_url; ?>assets/global/img/slider-5.jpg" alt="..." class="img-responsive">
                     </div>
                     <div class="item">
                        <img src="<?php echo $base_url; ?>assets/global/img/slider-6.jpg" alt="..." class="img-responsive">
                     </div>
                     <div class="item">
                        <img src="<?php echo $base_url; ?>assets/global/img/slider-7.jpg" alt="..." class="img-responsive">
                     </div>
                  </div>
                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <!-- END:SLIDER SECTION -->
      <!-- BEGIN:SECTION ONE -->
      <div class="section-one wow fadeInDown" data-wow-delay="0.2s">
         <div class="container">
            <div class="row">
               <div class="col-md-6 text-center">
                  <img src="<?php echo $base_url; ?>assets/global/img/about-us.png" alt="" class="img-responsive">
                  <a href="<?php echo $base_url; ?>services" class="read-more">Read More <i class="fas fa-angle-right"></i></a>
               </div>
               <div class="col-md-6">
                  <h2>WELCOME TO THE GLOBAL PATIENT TRANSFER WEBSITE</h2>
                  <p>Global Patient Transfer is part of a global healthcare advisory and patient care improvement concept run by IMG Advisors LLC. We strongly believe in improving patient care services across the globe including international transfer assistance for healthcare needs. Global Patient Transfer and its team have many years of global healthcare experience that we have used to streamline the international patient transfer process and created services that benefit patients and their families.</p>
                  <p>We offer international patients assistance to seek healthcare anywhere n the Globe. We have created a smart portal that simplifies the whole process and offers case analysis as well as document uploads.</p>
                  <ul>
                     <li>
                        <p>Patients will create their personal profile</p>
                     </li>
                     <li>
                        <p>Add their medical history</p>
                     </li>
                     <li>
                        <p>Upload their diagnosis and reports.</p>
                     </li>
                     <li>
                        <p>Our representative will analyze their information and start exchanging information with the patient and their designated family member.</p>
                     </li>
                     <li>
                        <p>We will offer Information on Facilities, Treatment Plans, Logistics, Housing, and other assistance that match their needs.</p>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
<?php $this->load->view('common/process');?>
<?php $this->load->view('common/main-services-all');?>
<?php $this->load->view('common/counters');?>
<?php $this->load->view('common/map');?>
