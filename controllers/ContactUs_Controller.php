<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ContactUs_Controller extends Public_Controller
{

    public function index()
    {
        $this->load->library('form_validation');
        $this->load->library('captcha');
        $injectedScripts[] = $this->captcha->getScript();

        $data = array(
          'contact_submission_successful' => false,
          'GOOGLE_CAPTCHA_SITE_KEY' => $this->captcha->getSiteKey(),
          'injected_scripts' => implode('',$injectedScripts)
        );

        if ($this->form_validation->run('contact_us')) {

            $email_contant = <<<EOT
<pre>
Full Name     : {$this->input->post('full_name')}
Email Address : {$this->input->post('email_address')}
Phone Number  : {$this->input->post('phone_number')}
Subject       : {$this->input->post('subject')}
Message       : {$this->input->post('message')}
</pre>
EOT;
            $patientId = $this->sendContactEmail($email_contant);
            $data['contact_submission_successful'] = true;
        }
        $this->render('contact-us', $data);
    }

    public function verify_captcha($value)
    {
        if(!$this->captcha->verify($value, $this->input->server('REMOTE_ADDR'))){
            $this->form_validation->set_message('verify_captcha', 'Verify if you are human?');
            return false;
        }
        return true;
    }

    private function sendContactEmail($html)
    {
        $this->load->library('email');

        $this->email->from($this->config->config['gpt_email_config']['contact_receiver'], 'Global Patient Website');
        $this->email->to($this->config->config['gpt_email_config']['contact_receiver']);
        $this->email->subject($this->config->config['site_title'].' :: New Contact From Submission');
        $this->email->message($html);
        $this->email->send();
    }
}
