<div class="banner-section">
            <img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
            <div class="container">
               <h2>Patient Registration</h2>
               <ul class="list-inline">
                  <li><h3>Home</h3></li>
                  <li><h3>/</h3></li>
                  <li><h3>Registration</h3></li>
               </ul>
            </div>
         </div>




	 <div class="section-one contact-sec wow fadeInDown" data-wow-delay="0.2s">
         <div class="container">
            <div class="row">
            
              <div class="col-md-6 col-md-offset-3">
               <div class="contact-form">
                 <h2>Patient Registration</h2>
                 <?php if ($user_creation_successful):?>
				  <div class="alert alert-success" role="alert">Registration successful. Kindly check your email for verification link.</div>
				  <?php endif;?>
				  <?php echo form_open('register-patient'); ?>
							  
				 
          			<input type="text" class="form-control" id="username" name="username" placeholder="Username">
					<?php echo form_error('username'); ?>
							  
				  
				   <select class="form-control" name="salutation" id="salutation">
					<?php foreach ($salutations as $salutation):?>
					  <option value="<?php echo $salutation;?>"><?php echo $salutation;?></option>
					<?php endforeach;?>
				  </select>
		  
				 <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
				<?php echo form_error('first_name'); ?>
				
				<input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name">
				
				
				<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
        	  	<?php echo form_error('last_name'); ?>
					
					
					
				 <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Email Address" >
          		<?php echo form_error('email_address'); ?>
                  
				  
				  <select class="form-control" name="gender" id="gender">
					<option value="M">Male</option>
					<option value="F">Female</option>
				  </select>
				  
				  
				  <input placeholder="Date of birth (mm/dd/yyyy)" type="text" class="form-control gpt-datepicker" id="date_of_birth" name="date_of_birth" readonly="readonly">
         		 <?php echo form_error('date_of_birth'); ?>
				 
          		<div class="g-recaptcha" data-sitekey="<?php echo $GOOGLE_CAPTCHA_SITE_KEY;?>"></div>
					 <?php echo form_error('g-recaptcha-response'); ?>
				<div class="col-md-9" style="padding-top: 26px;">	
					<p class="checkbox"> <input type="checkbox" name="term_of_use" class="form-control"> I agree to the <a href="<?php echo $base_url;?>terms-of-use">Terms of use</a>.</p>
					<p id="error_term_of_use" style="display:none">Please agree to our terms of use.</p>	  
				</div>  
					
				<div class="col-md-3">				
					 <input type="submit" value="Submit" class="read-more" />
                 </div> 
                <?php echo form_close(); ?>
				
               </div>  
              </div>
            </div>
         </div>
      </div>
