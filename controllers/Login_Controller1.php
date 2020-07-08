<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_Controller extends Public_Controller
{
    private $user;

    public function check_login($value)
    {
        if (trim($value) === '') {
            $this->form_validation->set_message('check_login', 'The Username field is required');
            return false;
        }


        $this->load->library('Password');
        $repository = $this->doctrine->em->getRepository('GptUser');

        $user =  $repository->findOneBy([
                    'username' => $this->input->post('username'),
                    'role'     => $this->input->post('login_as')
                  ]);

        if (!$user) {
            $this->form_validation->set_message('check_login', 'Username does not exist');
            return false;
        } elseif (!$user->isActive()) {
            $this->form_validation->set_message('check_login', 'User is not activated. Please contact administrator');
            return false;
        } elseif (!$this->password->validate($this->input->post('password'), $user->getPassword())) {
            $this->form_validation->set_message('check_login', 'You have entered an invalid password');
            return false;
        } else {
            $this->user = $user;
            return true;
        }
    }

    // index = login
    public function index()
    {
        if ($this->isLoggedIn()) {
            redirect('');
        }

        $this->load->library('form_validation');

        if ($this->form_validation->run('login') == false) {
            $this->render('login');
        } else {
            $this->initializeLogin();
        }
    }

    private function initializeLogin()
    {
        $this->setUserInSession($this->user);
        redirect('');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
