
<div class="banner-section">
	<img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
	<div class="container">
	   <h2>Contact Us</h2>
	   <ul class="list-inline">
		  <li><h3>Home</h3></li>
		  <li><h3>/</h3></li>
		  <li><h3>Contact</h3></li>
	   </ul>
	</div>
 </div>
 
 
 <div class="section-one contact-sec wow fadeInDown" data-wow-delay="0.2s">
         <div class="container">
            <div class="row">
              <div class="col-md-6">
                 <ul class="list-unstyled">
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/envelope-icon.png"></span><a href="mailto:support@global-patienttransfer.com">support@global-patienttransfer.com</a></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/map-icon.png"></span><p>USA (HEADQUARTERS) 3139 W. Holcombe Blvd, #670 Houston, Texas 77025, USA</p></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/phone-icon.png"></span><a href="tel:+1-713-900-4882">+1-713-900-4882</a></li>
                 </ul>
                  <ul class="list-unstyled">
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/envelope-icon.png"></span><a href="mailto:support@global-patienttransfer.com">support@global-patienttransfer.com</a></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/map-icon.png"></span><p>USA (Houston, Texas) 5444 Westheimer Road, Suite 1000 Houston, Texas 77056, USA</p></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/phone-icon.png"></span><a href="tel:+1-713-900-4882">+1-713-900-4882</a></li>
                 </ul>
                  <ul class="list-unstyled">
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/envelope-icon.png"></span><a href="mailto:support@global-patienttransfer.com">support@global-patienttransfer.com</a></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/map-icon.png"></span><p>USA (New York) 50 Fountain Plaza, Suite 1400 Buffalo, New York 14202, USA</p></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/phone-icon.png"></span><a href="tel:+1-713-900-4882">+1-713-900-4882</a></li>
                 </ul>
                  <ul class="list-unstyled">
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/envelope-icon.png"></span><a href="mailto:support@global-patienttransfer.com">support@global-patienttransfer.com</a></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/map-icon.png"></span><p>USA (Atlanta) Tower Place 200, 3348 Peachtree Road Suite 700, Atlanta, GA 30326</p></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/phone-icon.png"></span><a href="tel:+1-713-900-4882">+1-713-900-4882</a></li>
                 </ul>
				 <ul class="list-unstyled">
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/envelope-icon.png"></span><a href="mailto:support@global-patienttransfer.com">support@global-patienttransfer.com</a></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/map-icon.png"></span><p>UAE (Dubai) DAMAC Smart Heights, 23rd Floor, Barsha Heights P O BOX 393578, Dubai, UAE</p></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/phone-icon.png"></span><a href="tel:+1-713-900-4882">+1-713-900-4882</a></li>
                 </ul>
				 <ul class="list-unstyled">
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/envelope-icon.png"></span><a href="mailto:support@global-patienttransfer.com">support@global-patienttransfer.com</a></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/map-icon.png"></span><p>PAKISTAN (Lahore) 12 CCA Street 7 Floor 1 DHA Phase 4 Lahore, Pakistan</p></li>
                    <li><span><img src="<?php echo $base_url;?>assets/global/img/phone-icon.png"></span><a href="tel:+1-713-900-4882">+1-713-900-4882</a></li>
                 </ul>
              </div>
              <div class="col-md-6">
               <div class="contact-form">
                 <h2>Contact Form</h2>
				 
				 <?php if ($contact_submission_successful):?>
					<div class="alert alert-success" role="alert">
					  Thank you for contacting us. <br /><br />
					  We have received the email and someone from our team will connect with you shortly. <br /><br />
					  Thanks
					</div>
				<?php else: ?>
					<?php echo form_open('contact-us'); ?>
						<input type="text" class="form-control" placeholder="Full Name" name="full_name">
						 <?php echo form_error('full_name'); ?>
						<input type="email" class="form-control" placeholder="Email Address " name="email_address">
						<?php echo form_error('email_address'); ?>
						<input type="text" class="form-control" placeholder="Phone Number" name="phone_number">
						 <?php echo form_error('phone_number'); ?>
						<input type="text" class="form-control" placeholder="Subject" name="subject">
						 <?php echo form_error('subject'); ?>
						<textarea class="form-control sec" placeholder="Message" name="message"></textarea>
						<?php echo form_error('message'); ?>
                  <?php echo form_error('captcha'); ?>
          		   <div class="g-recaptcha" data-sitekey="<?php echo $GOOGLE_CAPTCHA_SITE_KEY;?>"></div>
						<input type="submit" value="Submit" class="read-more pull-right">
						
					<?php echo form_close(); ?>
				<?php endif;?>
               </div>  
              </div>
            </div>
         </div>
      </div>	 
		 
<?php $this->load->view('common/main-services');?>
<?php $this->load->view('common/process');?>
<?php $this->load->view('common/map');?>
