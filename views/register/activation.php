<?php $role = $user->getRole();?>
<div class="banner-section">
   <img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
   <div class="container">
      <h2>User Activation</h2>
      <ul class="list-inline">
         <li>
            <h3>Home</h3>
         </li>
         <li>
            <h3>/</h3>
         </li>
         <li>
            <h3>User Activation</h3>
         </li>
      </ul>
   </div>
</div>
<div class="section-one contact-sec wow fadeInDown" data-wow-delay="0.2s">
   <div class="container">
      <div class="row">
         <div class="col-md-6 col-md-offset-3">
            <div class="contact-form">
               <h2>User Activation</h2>
               <?php echo form_open('', ['id'=>'user_activation']); ?>
               <div class="alert alert-secondary" role="alert">
                  Setup your password to activate your account.
               </div>
               <?php if ($role != GptUser::USER_ROLE_PATIENT):?>
               <input type="text" class="form-control" id="username" name="username" placeholder="Username">
               <?php echo form_error('username', '<p class="gpt_form_error">', '</p>'); ?>
               <?php endif;?>
               <input type="password" class="form-control" id="password" name="password" placeholder="Password">
               <?php echo form_error('password', '<p class="gpt_form_error">', '</p>'); ?>
               <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
               <?php echo form_error('confirm_password', '<p class="gpt_form_error">', '</p>'); ?>
               <input type="submit" value="Submit" class="read-more pull-right" />
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</div>