


		<div class="banner-section">
            <img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
            <div class="container">
               <h2>Forgot Password?</h2>
               <ul class="list-inline">
                  <li><h3>Home</h3></li>
                  <li><h3>/</h3></li>
                  <li><h3>Forgot Password</h3></li>
               </ul>
            </div>
         </div>




	 <div class="section-one contact-sec wow fadeInDown" data-wow-delay="0.2s">
         <div class="container">
            <div class="row">
            
              <div class="col-md-6 col-md-offset-3">
               <div class="contact-form">
                 <h2>Forgot Password?</h2>
               <?php if ($currentPageData['posted']):?>
				<div class="alert alert-<?php echo ($currentPageData['success'])?'success':'danger';?>" role="alert">
				  <?php echo $currentPageData['message'];?>
				</div>
			  <?php endif;?>
				<?php echo form_open(''); ?>
				   <input class="form-control" name="email" id="email" type="text" placeholder="Enter email" required>
					 <input type="submit" value="Submit" class="read-more pull-right" />
                    <ul class="list-inline">
                      <li><a href="<?php echo $base_url;?>register-patient">Register an Account</a></li>
                      <li><a href="<?php echo $base_url;?>login">Proceed with Login</a></li>
                    </ul>
                <?php echo form_close(); ?>
               </div>  
              </div>
            </div>
         </div>
      </div>