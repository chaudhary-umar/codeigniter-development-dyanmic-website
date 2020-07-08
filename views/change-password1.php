

		<div class="banner-section">
            <img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
            <div class="container">
               <h2>Change Password</h2>
               <ul class="list-inline">
                  <li><h3>Home</h3></li>
                  <li><h3>/</h3></li>
                  <li><h3>Change Password</h3></li>
               </ul>
            </div>
         </div>




	 <div class="section-one contact-sec wow fadeInDown" data-wow-delay="0.2s">
         <div class="container">
            <div class="row">
            
              <div class="col-md-6 col-md-offset-3">
               <div class="contact-form">
                 <h2>Change Password</h2>
                <?php if($currentPageData['link_expired']): ?>
				<div class="alert alert-danger" role="alert">
					  Link has been expired. Click <a href="<?php echo $base_url;?>forget-password">here</a> to request another link.
					</div>
				<?php elseif($currentPageData['user_not_found']): ?>
				<div class="alert alert-danger" role="alert">
					  Unable to find user this link was generated for. Click <a href="<?php echo $base_url;?>forget-password">here</a> to request another link.
					</div>
				<?php elseif($currentPageData['reset_successful']): ?>
				<div class="alert alert-success" role="alert">
					  Password has been updated successfully. Click <a href="<?php echo $base_url;?>login">here</a> to login.
					</div>
				<?php else:?>
				  <?php echo form_open('', ['id'=>'change_password']); ?>
                  
				   <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          			<?php echo form_error('password'); ?>
				  
				  
				  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
         			 <?php echo form_error('confirm_password'); ?>
		  
		  
                  
                    
					 <input type="submit" value="Submit" class="read-more pull-right" />
                   
                <?php echo form_close(); ?>
				<?php endif;?>
               </div>  
              </div>
            </div>
         </div>
      </div>