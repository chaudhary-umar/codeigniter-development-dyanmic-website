<div class="banner-section">
    <img src="<?php echo $base_url;?>assets/global/img/service-banner.png" alt="" class="img-responsive">
    <div class="container">
        <h2>Hospitals</h2>
        <ul class="list-inline">
            <li>
                <h3>Home</h3>
            </li>
            <li>
                <h3>/</h3>
            </li>
            <li>
                <h3>Hospitals</h3>
            </li>
        </ul>
    </div>
</div>

<div class="section-one wow fadeInDown" data-wow-delay="0.2s">
    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>WE OFFER COMPREHENSIVE SERVICES TO PATIENTS SEEKING HEALTHCARE SERVICES GLOBALLY</h2>
                    <p>Global Patient Transfer is a specialized and distinctive service for patients that need healthcare services globally. Our service start with patient registration and medical report uploads and aligns patients with the right facility
                        and doctor.</p>

                    <p>Our patients come with proper orientation and support to let you focus on providing care for the patient healthcare needs.</p>
                </div>
                <div class="col-md-12">
                    <h2>YOUR CARE EXTENDS GLOBALLY WITH US</h2>
                    <p>Global Patient Transfer has global offices and partnerships with many facilities that send their patients to anywhere in the world for their healthcare needs. We have mastered the process and invested in the right technology to create
                        a SMART system for our Hospital partners in terms of patient qualifications, documents, case tracking, and treatment follow ups.</p>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="contact-form">
                <?php echo form_open('hospitals'); ?>
                <?php if ($form_submission_successful):?>
                <div class="alert alert-success" role="alert">Registration successful. One of our representative will contact you soon.</div>
                <?php endif;?>
                <?php echo form_error('full_name', '<p class="gpt_form_error">', '</p>'); ?>
                <input type="text" class="form-control" placeholder="Full Name" name="full_name">
                <?php echo form_error('email_address', '<p class="gpt_form_error">', '</p>'); ?>
                <input type="email" class="form-control" placeholder="Email Address " name="email_address">
                <?php echo form_error('phone_number', '<p class="gpt_form_error">', '</p>'); ?>
                <input type="text" class="form-control" placeholder="Phone Number" name="phone_number">
                <?php echo form_error('hospital_name', '<p class="gpt_form_error">', '</p>'); ?>
                <input type="text" class="form-control" placeholder="Hospital Name" name="hospital_name">
                <?php echo form_error('g-recaptcha-response', '<p class="gpt_form_error">', '</p>'); ?>
                <div class="g-recaptcha" data-sitekey="<?php echo $GOOGLE_CAPTCHA_SITE_KEY;?>"></div>
                <div class="col-md-9" style="padding-top: 26px;">	
					<p class="checkbox"> <input type="checkbox" name="term_of_use" class="form-control"> I agree to the <a href="<?php echo $base_url;?>terms-of-use">Terms of use</a>.</p>
                    <p id="error_term_of_use" style="display:none">Please agree to our terms of use.</p>
                </div>
                 <input type="submit" value="Submit" class="read-more pull-right">
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/process');?>
<?php $this->load->view('common/main-services');?>
<?php $this->load->view('common/counters');?>
<?php $this->load->view('common/map');?>