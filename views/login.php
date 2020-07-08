


		<div class="banner-section">
            <img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
            <div class="container">
               <h2>Patient Login</h2>
               <ul class="list-inline">
                  <li><h3>Home</h3></li>
                  <li><h3>/</h3></li>
                  <li><h3>Login</h3></li>
               </ul>
            </div>
         </div>




	 <div class="section-one contact-sec wow fadeInDown" data-wow-delay="0.2s">
         <div class="container">
            <div class="row">
            
              <div class="col-md-6 col-md-offset-3">
               <div class="contact-form">
                 <h2>Login</h2>
                <?php if ($this->input->get('activation') === '1'):?>
					<div class="alert alert-success" role="alert">
					  User has been activated. Kindly login to access your account.
					</div>
				  <?php endif;?>
					
					<?php echo form_open('login'); ?>
          <?php echo validation_errors('<p class="gpt_form_error">', '</p>'); ?>
				  
				   <select class="form-control" name="login_as" id="login_as">
					   <option value="<?php echo GptUser::USER_ROLE_PATIENT;?>">Patient</option>
					  <option value="<?php echo GptUser::USER_ROLE_HOSPITAL_REP;?>">Hospital</option>
					  <option value="<?php echo GptUser::USER_ROLE_SERVICE_PROVIDER;?>">Service Provider</option>
                   </select>
				   
				   
                 
					<input class="form-control" name="username" value="<?php echo set_value('username');?>" id="username" type="text" aria-describedby="usernnameHelp" placeholder="Username">
					
					 <input class="form-control" name="password" id="password" type="password" placeholder="Password">
                  
                    
					 <input type="submit" value="Submit" class="read-more pull-right" />
                    <ul class="list-inline">
                      <li><a href="<?php echo $base_url;?>register-patient">Register an Account</a></li>
                      <li><a href="<?php echo $base_url;?>forget-password">Forgot Password</a></li>
                    </ul>
                <?php echo form_close(); ?>
               </div>  
              </div>
            </div>
         </div>
      </div>