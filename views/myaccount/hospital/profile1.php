<div class="contact-form profile-form">
	<?php if ($profile_update_successful):?>
	<div class="alert alert-success" role="alert">Your profile has been updated successfully.</div>
	<?php endif;?>
	<?php echo form_open('', ['id' => 'frm_hospital_user_profile']); ?>
	<div class="form-group row">
		<label for="username" class="col-sm-2 col-form-label">Username</label>
		<div class="col-sm-10">
			<input type="text" readonly class="form-control" placeholder="Username" value="<?php echo $user->getUserName();?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" value="<?php echo $user_detail->getDisplayName();?>">
			<?php echo form_error('full_name'); ?>
		</div>
	</div>
	<div class="form-group row">
		<label for="email_address" class="col-sm-2 col-form-label">Email Address</label>
		<div class="col-sm-10">
			<input type="text" readonly class="form-control" placeholder="Email Address" value="<?php echo $user->getEmail();?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Phone Number" id="phone_number" name="phone_number" value="<?php echo $user_detail->getPhoneNo();?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="hospital_name" class="col-sm-2 col-form-label">Hospital Name</label>
		<div class="col-sm-10">
			<input type="text" readonly class="form-control" placeholder="Hospital Name" value="<?php echo $user_detail->getHospital()->getHospitalName();?>">
		</div>
	</div>
	<div class="form-group row">
		<?php echo form_error('captcha'); ?>
		<div class="g-recaptcha" data-sitekey="<?php echo $GOOGLE_CAPTCHA_SITE_KEY;?>"></div>
	</div>
	<div class="form-group row">
		<input type="submit" value="Update Profile" class="read-more pull-right" />
	</div>
	<?php echo form_close(); ?>
</div>