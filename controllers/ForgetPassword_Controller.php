<?php 


class ForgetPassword_Controller extends Public_Controller
{

	public function index()
	{
		$this->load->library('form_validation');
		$email_address = $this->input->post('email');
		$data = ['posted' => false];

		if($email_address)
		{
			$userRepository = $this->doctrine->em->getRepository('GptUser');
			$user = $userRepository->findOneBy([
				'email' => $email_address
			]);

			if($user)
			{
				$this->sendForgetPasswordResetLink($user);
				$data = ['posted' => true, 'success' => true, 'message' => 'Link to reset password has been sent to your email address.'];
			}
			else 
			{
				$data = ['posted' => true, 'success' => false, 'message' => 'Email is not registered. Please enter the email address you are registered with.'];
			}
		}
		$this->render('forget', $data);
	}

	private function sendForgetPasswordResetLink($user){

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

		$html = $this->parser->parse('email/reset-password', [
          'email_address' => $user->getEmail(),
          'reset_link' => $this->getResetLink($user)
        ], true);

        $this->email->from($this->config->config['gpt_email_config']['from_email'], $this->config->config['gpt_email_config']['from_name']);
        $this->email->to($user->getEmail());
        $this->email->subject($this->config->config['site_title'].' :: Reset Password');
        $this->email->message($html);
        $this->email->send();

	}

	private function getResetLink($user){

		$validity = time() + (60 * 60); // valid for one hour
		$data = (object) array($user->getUserName(), $user->getEmail(), $validity);
		$code = urlencode(base64_encode(json_encode($data)));
		
		return base_url().'r/'.$code;

	}

	private function parseResetLink($link){
		return json_decode(base64_decode(urldecode($link)));
	}

	public function resetPassword($reset_link){

		$link_data = $this->parseResetLink($reset_link);
		$data = ['link_expired' => false, 'reset_successful' => false, 'user_not_found' => false];

		if($link_data && isset($link_data->{2}) && time() < $link_data->{2}){ // if data is valid and link is not expired

			$this->load->library('form_validation');
			$userRepository = $this->doctrine->em->getRepository('GptUser');
			$user = $userRepository->findOneBy([
				'email' => $link_data->{1},
				'username' => $link_data->{0}
			]);

			if($user){
				$this->load->vars([
					'injected_scripts' => '<script src="'.base_url().'/assets/js/pwstrength-bootstrap.min.js"></script>'
				  ]);
				  if ($this->form_validation->run('change_password')) {
					$this->load->library('Password');
					$user->setPassword($this->password->make($this->input->post('password')));
					$this->doctrine->em->persist($user);
					$this->doctrine->em->flush();
					$data['reset_successful'] = true;
				}
			} else {
				$data['user_not_found'] = true;
			}
			
		} else {
			$data['link_expired'] = true;
		}

		$this->render('change-password', $data);
	}
}