<div class="contact-form profile-form">
	<?php if ($profile_update_successful):?>
	<div class="alert alert-success" role="alert">Your profile has been updated successfully.</div>
	<?php endif;?>
	<?php echo form_open('', ['id' => 'frm_patient_profile']); ?>

	<div class="form-group row">
		<label for="username" class="col-sm-2 col-form-label">Username</label>
		<div class="col-sm-10">
			<input type="text" readonly class="form-control" placeholder="Username" value="<?php echo $user->getUserName();?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="salutation" class="col-sm-2 col-form-label">Salutation</label>
		<div class="col-sm-10">
			<select class="form-control" name="salutation" id="salutation">
				<?php $userSalutation = $user_detail->getSalutation();
							foreach ($salutations as $salutation):?>
				<option value="<?php echo $salutation;?>" <?php echo ($salutation===$userSalutation)?' selected':'';?>>
					<?php echo $salutation;?>
				</option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label for="first_name" class="col-sm-2 col-form-label">First Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" value="<?php echo $user_detail->getFirstName();?>">
			<?php echo form_error('first_name'); ?>
		</div>
	</div>
	<div class="form-group row">
		<label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Middle Name" id="middle_name" name="middle_name" value="<?php echo $user_detail->getMiddleName();?>">
		</div>
	</div>
	<div class="form-group row">
		<label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name" value="<?php echo $user_detail->getLastName();?>">
			<?php echo form_error('last_name'); ?>
		</div>
	</div>
	<div class="form-group row">
		<label for="email_address" class="col-sm-2 col-form-label">Email Address</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" placeholder="Email Address" id="email_address" name="email_address" value="<?php echo $user->getEmail();?>" readonly />
		</div>
	</div>

	<div class="form-group row">
		<label for="username" class="col-sm-2 col-form-label">Gender</label>
		<div class="col-sm-10">
			<select class="form-control">
				<option value="M" <?php echo ($user_detail->getGender() === 'M')?' selected':'';?>>Male</option>
				<option value="F" <?php echo ($user_detail->getGender() === 'F')?' selected':'';?>>Female</option>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label for="date_of_birth" class="col-sm-2 col-form-label">Date of Birth</label>
		<div class="col-sm-10">
			<input type="text" class="form-control gpt-datepicker" id="date_of_birth" name="date_of_birth" value="<?php echo $user_detail->getDOB();?>"
			 readonly="readonly">
			<?php echo form_error('date_of_birth'); ?>
		</div>
	</div>

	<div class="form-group row">
		<?php echo form_error('captcha'); ?>
		<div class="g-recaptcha" data-sitekey="<?php echo $GOOGLE_CAPTCHA_SITE_KEY;?>">
		</div>
	</div>

	<div class="form-group row">
		<input type="submit" value="Update Profile" class="read-more pull-right" />
	</div>
	<?php echo form_close(); ?>
</div>