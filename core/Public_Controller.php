<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH. '../common/core/GPT_Controller.php';

class Public_Controller extends GPT_Controller
{
    private $searchData = null;

    public function __construct()
    {
        parent::__construct();
        $this->searchData = $this->getSearchDropDownData();

        $this->load->vars(array(
          'header' => 'common/header',
          'footer' => 'common/footer',
          'all_services' => 'common/main-services-all',
          'selected_services' => 'common/main-services',
          'map' => 'common/map',
          'process' => 'common/process',
          'injected_scripts' => ''
      ));

    }

    protected function render($template, $data = [])
    {
        $data['isUserLoggedIn'] = $this->isLoggedIn();
        $data['search_countries'] = $this->searchData['countries'];
        $data['search_departments'] = $this->searchData['departments'];

        $this->load->vars(array(
          'currentPage' => $template,
          'currentPageData' => $data,
        ));
        $this->load->view('common/base');
    }

    protected function setUserInSession($user)
    {
        $this->session->set_userdata('user', (object)[
        'id'    =>  $user->getId(),
        'role'  =>  $user->getRole()
      ]);
    }

    private function getSearchDropDownData(){

        $data = [];
        $departments = [];
        $data['countries'] = $this->config->config['gpt_variable']['unsorted_countries'];

        $em = $this->doctrine->em;

        $deptRepository = $em->getRepository('GptHospitalDept');
        $depts = $deptRepository->findBy(array(),array('hospitalDeptName'=>'ASC'));

        foreach($depts as $department){
            $departments[] = $department->getDepartmentName();
        }

        $data['departments'] = $departments;

        sort($data['departments']);

        return $data;
    }
}
