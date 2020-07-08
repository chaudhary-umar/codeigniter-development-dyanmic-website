<?php

$config = array(
  'login' => array(
    array(
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'callback_check_login'
      ),
      array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
      ),
  ),
  'user_activation' => array(
    array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
      ),
      array(
        'field' => 'confirm_password',
        'label' => 'Confirm Password',
        'rules' => 'required|matches[password]'
      ),
  ),
  'user_activation_with_username' => array(
    array(
      'field' => 'username',
      'label' => 'Password',
      'rules' => 'callback_check_username'
    ),
    array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
      ),
      array(
        'field' => 'confirm_password',
        'label' => 'Confirm Password',
        'rules' => 'required|matches[password]'
      ),
  ),
  'change_password' => array(
    array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
      ),
      array(
        'field' => 'confirm_password',
        'label' => 'Confirm Password',
        'rules' => 'required|matches[password]'
      ),
  ),
  'contact_us' => array(
    array(
        'field' => 'full_name',
        'label' => 'Full Name',
        'rules' => 'required'
      ),
      array(
        'field' => 'email_address',
        'label' => 'Email Address',
        'rules' => 'required'
      ),
      array(
        'field' => 'phone_number',
        'label' => 'Phone Number',
        'rules' => 'required'
      ),
      array(
        'field' => 'subject',
        'label' => 'Subject',
        'rules' => 'required'
      ),
      array(
        'field' => 'message',
        'label' => 'Message',
        'rules' => 'required'
      ),
      array(
        'field' => 'g-recaptcha-response',
        'label' => 'Captcha',
        'rules' => 'callback_verify_captcha',
        'error_prefix' => '<small id="error_captcha" class="form-text text-muted">',
        'error_suffix' => '</small>'
      )
    ),
    'hospital_registration' => array(
      array(
          'field' => 'full_name',
          'label' => 'Full Name',
          'rules' => 'required'
        ),
        array(
          'field' => 'email_address',
          'label' => 'Email Address',
          'rules' => 'callback_check_email'
        ),
        array(
          'field' => 'phone_number',
          'label' => 'Phone Number',
          'rules' => 'required'
        ),
        array(
          'field' => 'hospital_name',
          'label' => 'Hospital Name',
          'rules' => 'required'
        ),
        array(
          'field' => 'g-recaptcha-response',
          'label' => 'Captcha',
          'rules' => 'callback_verify_captcha',
          'error_prefix' => '<small id="error_captcha" class="form-text text-muted">',
          'error_suffix' => '</small>'
        )
    ),
    'hospital_user_profile' => array(
      array(
          'field' => 'full_name',
          'label' => 'Full Name',
          'rules' => 'required'
        ),
      ),
      'provider_user_profile' => array(
        array(
            'field' => 'full_name',
            'label' => 'Full Name',
            'rules' => 'required'
          ),
        ),
    'provider_registration' => array(
      array(
          'field' => 'full_name',
          'label' => 'Full Name',
          'rules' => 'required'
        ),
        array(
          'field' => 'email_address',
          'label' => 'Email Address',
          'rules' => 'callback_check_email'
        ),
        array(
          'field' => 'phone_number',
          'label' => 'Phone Number',
          'rules' => 'required'
        ),
        array(
          'field' => 'company_name',
          'label' => 'Service Provider Name',
          'rules' => 'required'
        ),
        array(
          'field' => 'g-recaptcha-response',
          'label' => 'Captcha',
          'rules' => 'callback_verify_captcha',
          'error_prefix' => '<small id="error_captcha" class="form-text text-muted">',
          'error_suffix' => '</small>'
        )
    )
);

$patient_profile = array(
  array(
    'field' => 'first_name',
    'label' => 'First name',
    'rules' => 'required',
    'error_prefix' => '<small id="error_first_name" class="form-text text-muted">',
    'error_suffix' => '</small>'
  ),
  array(
    'field' => 'last_name',
    'label' => 'Last name',
    'rules' => 'required',
    'error_prefix' => '<small id="error_last_name" class="form-text text-muted">',
    'error_suffix' => '</small>'
  ),
  array(
    'field' => 'date_of_birth',
    'label' => 'Date of Birth',
    'rules' => 'required',
    'error_prefix' => '<small id="error_date_of_birth" class="form-text text-muted">',
    'error_suffix' => '</small>'
  ),
  array(
    'field' => 'g-recaptcha-response',
    'label' => 'Captcha',
    'rules' => 'callback_verify_captcha',
    'error_prefix' => '<small id="error_captcha" class="form-text text-muted">',
    'error_suffix' => '</small>'
  )
);

$patient_registration = array_merge($patient_profile, array(array(
  'field' => 'username',
  'label' => 'Username',
  'rules' => 'callback_check_patient_username',
  'error_prefix' => '<small id="error_username" class="form-text text-muted">',
  'error_suffix' => '</small>'
),
array(
  'field' => 'email_address',
  'label' => 'Email Address',
  'rules' => 'callback_check_email',
  'error_prefix' => '<small id="error_email_address" class="form-text text-muted">',
  'error_suffix' => '</small>'
),));

$config = array_merge($config, array('patient_registration' => $patient_registration, 'patient_profile' => $patient_profile));