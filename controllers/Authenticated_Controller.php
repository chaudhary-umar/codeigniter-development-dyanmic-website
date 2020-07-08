<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authenticated_Controller extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->isLoggedIn()) {
            redirect('login');
        }
    }
}
