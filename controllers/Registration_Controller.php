<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration_Controller extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('counters');

        
        if (!in_array($this->uri->uri_string, ['hospitals', 'providers']) && $this->isLoggedIn()) {
            redirect('');
        }
    }

    public function index()
    {
        redirect('register-patient');
    }

    public function verify_captcha($value)
    {
        if(!$this->captcha->verify($value, $this->input->server('REMOTE_ADDR'))){
            $this->form_validation->set_message('verify_captcha', 'Verify if you are human?');
            return false;
        }
        return true;
    }

    public function check_patient_username($value)
    {
        if (trim($value) === '') {
            $this->form_validation->set_message('check_patient_username', 'The Username is required');
            return false;
        }

        $this->repository = $this->doctrine->em->getRepository('GptUser');
        $user =  $this->repository->findOneBy([
                  'username' => $this->input->post('username'),
                  'role'     => GptUser::USER_ROLE_PATIENT
                ]);

        if ($user) {
            $this->form_validation->set_message('check_patient_username', 'Username already exists');
            return false;
        }
        return true;
    }

    public function check_username($value)
    {
        if (trim($value) === '') {
            $this->form_validation->set_message('check_username', 'The Username is required');
            return false;
        }

        $this->repository = $this->doctrine->em->getRepository('GptUser');
        $user =  $this->repository->findOneBy([
                  'username' => $this->input->post('username')
                ]);

        if ($user) {
            $this->form_validation->set_message('check_username', 'Username already exists');
            return false;
        }
        return true;
    }

    public function check_email($value)
    {
        if (trim($value) === '') {
            $this->form_validation->set_message('check_email', 'The Email Address is required');
            return false;
        }

        $this->repository = $this->doctrine->em->getRepository('GptUser');
        $user =  $this->repository->findOneBy([
                  'email' => $this->input->post('email_address')
                ]);

        if ($user) {
            $this->form_validation->set_message('check_email', 'Email Address already used.');
            return false;
        }
        return true;
    }

    public function registerPatient()
    {
        $this->load->library('form_validation');
        $this->load->library('captcha');
        
        $injectedScripts[] = $this->captcha->getScript();
        $injectedScripts[] = $this->getScriptTag('/assets/js/patient.js');
        $injectedScripts[] = '<script type="text/javascript" async="" src="'.$this->config->config['base_url'].'/assets/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>';
        $injectedScripts[] = '<link rel="stylesheet" href="'.$this->config->config['base_url'].'/assets/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.css"/>';

        $data = array(
          'user_creation_successful' => false,
          'salutations' => $this->config->config['gpt_variable']['salutation'],
          'GOOGLE_CAPTCHA_SITE_KEY' => $this->captcha->getSiteKey(),
          'injected_scripts' => implode('',$injectedScripts)
        );

        if ($this->form_validation->run('patient_registration')) {
            $patientId = $this->createPatient();
            $code = $this->createUser($patientId);
            $data['user_creation_successful'] = true;
        }
        $this->render('register/patient', $data);
    }

    private function createPatient()
    {
        $em = $this->doctrine->em;
        $patient = new GptPatient();
        $patient->setSalutation($this->input->post('salutation'));
        $patient->setFirstName($this->input->post('first_name'));
        $patient->setLastName($this->input->post('last_name'));
        $patient->setMiddleName($this->input->post('middle_name'));
        $patient->setDOB($this->input->post('date_of_birth'));
        $patient->setGender($this->input->post('gender'));
        $patient->preCreate();
        $em->persist($patient);
        $em->flush();
        return $patient->getId();
    }

    private function createHospitalUser()
    {
        $em = $this->doctrine->em;
        $user = new GptHospitalUser();
        $user->setFullName($this->input->post('full_name'));
        $user->setHospitalName($this->input->post('hospital_name'));
        $user->setPhoneNo($this->input->post('phone_number'));
        $user->preCreate();
        $em->persist($user);
        $em->flush();
        return $user->getId();
    }

    private function createComapnyUser()
    {
        $em = $this->doctrine->em;
        $user = new GptCompanyUser();
        $user->setFullName($this->input->post('full_name'));
        $user->setCompanyName($this->input->post('company_name'));
        $user->setPhoneNo($this->input->post('phone_number'));
        $user->preCreate();
        $em->persist($user);
        $em->flush();
        return $user->getId();
    }
    
    private function createTemporaryUser($associationId, $role = GptUser::USER_ROLE_PATIENT, $status = GptUser::USER_STATUS_AWAITING_VERIFICATION)
    {
        $em = $this->doctrine->em;
        $user = new GptUser();
        $user->setAssociationId($associationId);
        $user->setUserName('user_'.date('Ymdhis'));
        $user->setEmail($this->input->post('email_address'));
        $user->setStatus($status);
        $user->setRole($role);
        $user->setPassword("dummypassword"); // just to fill the column
        $user->preCreate();
        $em->persist($user);
        $em->flush();
        return $user;
    }

    private function createUser($associationId, $role = GptUser::USER_ROLE_PATIENT, $status = GptUser::USER_STATUS_AWAITING_VERIFICATION)
    {
        $em = $this->doctrine->em;
        $user = new GptUser();
        $user->setAssociationId($associationId);
        $user->setUserName($this->input->post('username'));
        $user->setEmail($this->input->post('email_address'));
        $user->setStatus($status);
        $user->setRole($role);
        $user->setPassword("dummypassword"); // just to fill the column
        $user->preCreate();
        $verification_code = $user->generateVerificationCode();
        $user->setVerificationCode($verification_code);
        $em->persist($user);
        $em->flush();

        $this->sendVerificationEmail($user, $verification_code);
        return $verification_code;
    }

    private function sendVerificationEmail($user, $code)
    {
		$config = array(
            'protocol'		=> 'sendmail',
            'mailpath'		=> '/usr/sbin/sendmail',
            'smtp_host'     => 'email-smtp.eu-west-1.amazonaws.com',
            'smtp_port'     => 587,
            'smtp_user'     => 'AKIAJ5YQB3IWCOGVIEWA',
            'smtp_pass'     => 'BFO6Oy6ufvdRFnwrdvYJ5NGmOSkBGQf1RSixiG9371Kw',
			'priority'		=> '1',
			'charset'		=> 'utf-8',
			'mailtype'		=> 'html',
			'crlf'			=> '\r\n',
			'newline'		=> '\r\n'			
		);
		
		$this->load->library('email', $config);        
        //$this->load->library('email');
        $this->load->library('parser');

        $html = $this->parser->parse('email/verification', [
          'username' => $user->getUserName(),
          'verification_link' => $user->getVerificationLink()
        ], true);

        $this->email->from($this->config->config['gpt_email_config']['from_email'], $this->config->config['gpt_email_config']['from_name']);
        $this->email->to($user->getEmail());
        $this->email->subject($this->config->config['site_title'].' :: Verification required');
        $this->email->message($html);
        $this->email->send();
    }

    private function sendNotificationEmail($data, $type){

		$config = array(
            'protocol'		=> 'sendmail',
            'mailpath'		=> '/usr/sbin/sendmail',
            'smtp_host'     => 'email-smtp.eu-west-1.amazonaws.com',
            'smtp_port'     => 587,
            'smtp_user'     => 'AKIAJ5YQB3IWCOGVIEWA',
            'smtp_pass'     => 'BFO6Oy6ufvdRFnwrdvYJ5NGmOSkBGQf1RSixiG9371Kw',
			'priority'		=> '1',
			'charset'		=> 'utf-8',
			'mailtype'		=> 'html',
			'crlf'			=> '\r\n',
			'newline'		=> '\r\n'			
		);
		
		$this->load->library('email', $config);
        //$this->load->library('email');
        $this->load->library('parser');

        $html = $this->parser->parse('email/notification', $data, true);
        
        $this->email->from($this->config->config['gpt_email_config']['from_email'], $this->config->config['gpt_email_config']['from_name']);
        $this->email->to($this->config->config['gpt_email_config']['registration_notification_receiver']);
        $this->email->subject($this->config->config['site_title'].' :: '.$type.' registration request');
        $this->email->message($html);
        $this->email->send();
    }

    public function registerHospital()
    {
        $this->load->library('form_validation');
        $this->load->library('captcha');

        $injectedScripts[] = $this->captcha->getScript();

        $data = array(
            'form_submission_successful' => false,
            'GOOGLE_CAPTCHA_SITE_KEY' => $this->captcha->getSiteKey(),
            'injected_scripts' => implode('',$injectedScripts),
            'counters' => [
                'count_most_searched_countries',
                'count_most_hospitals_by_country',
                'count_most_searched_departments',
                'count_cities_serviced',
                'count_most_hospital_by_city',
                'count_patients'
            ]
          );
  
          if ($this->form_validation->run('hospital_registration')) {
              $hospitalUserId = $this->createHospitalUser();
              $user = $this->createTemporaryUser($hospitalUserId, GptUser::USER_ROLE_HOSPITAL_REP, GptUser::USER_STATUS_INACTIVE);
              $rows = [
                'type' => 'hospital',
                'rows' => array(
                    array('title' => 'Full Name', 'value' => $this->input->post('full_name')),
                    array('title' => 'Email Address', 'value' => $this->input->post('email_address')),
                    array('title' => 'Phone No', 'value' => $this->input->post('phone_number')),
                    array('title' => 'Hospital Name', 'value' => $this->input->post('hospital_name')))
                ];
              $this->sendNotificationEmail($rows, 'Hospital');
              $data['form_submission_successful'] = true;
          }
          $this->render('register/hospitals', $data);
    }

    public function registerServiceProvider()
    {
        $this->load->library('form_validation');
        $this->load->library('captcha');

        
        $injectedScripts[] = $this->captcha->getScript();

        $data = array(
            'form_submission_successful' => false,
            'GOOGLE_CAPTCHA_SITE_KEY' => $this->captcha->getSiteKey(),
            'injected_scripts' => implode('',$injectedScripts),
            'counters' => [
                'count_patients',
                'count_service_providers',
                'count_most_liked_service_provider',
                'count_service_provider_services',
                'lowest_priced_service_provider_service',
                'highest_priced_service_provider_service'
            ]
          );
  
          if ($this->form_validation->run('provider_registration')) {
              $companyUserId = $this->createComapnyUser();
              $user = $this->createTemporaryUser($companyUserId, GptUser::USER_ROLE_SERVICE_PROVIDER, GptUser::USER_STATUS_INACTIVE);
              $rows = [
                'type' => 'service provider',
                'rows' => array(
                    array('title' => 'Full Name', 'value' => $this->input->post('full_name')),
                    array('title' => 'Email Address', 'value' => $this->input->post('email_address')),
                    array('title' => 'Phone No', 'value' => $this->input->post('phone_number')),
                    array('title' => 'Service Provider Name', 'value' => $this->input->post('company_name')))
                ];
              $this->sendNotificationEmail($rows, 'Service Provider');
              $data['form_submission_successful'] = true;
          }
          $this->render('register/providers', $data);
    }
}
