<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'controllers/Authenticated_Controller.php';

use Doctrine\Common\Collections\Criteria;

class MyAccount_Controller extends Authenticated_Controller
{
    
    public function index(){
        $user = $this->getUser();

        switch($user->getRole()){
            case GptUser::USER_ROLE_PATIENT:
                $this->indexPatient($user);
            break;
            case GptUser::USER_ROLE_HOSPITAL_REP:
                $this->indexHospital($user);
            break;
            case GptUser::USER_ROLE_SERVICE_PROVIDER:
                $this->indexProvider($user);
            break;
            default:
            redirect('');
            break;
        }
    }

    private function indexHospital(&$user){

        $this->load->library('form_validation');
        $this->load->library('captcha');

        $user_detail = $user->getDetail($this->doctrine->em);
        $injectedScripts[] = $this->captcha->getScript();
        $injectedScripts[] = $this->getScriptTag('/assets/js/hospital.js');
        $injectedScripts[] = '<script type="text/javascript" async="" src="'.$this->config->config['base_url'].'/assets/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>';
        $injectedScripts[] = '<link rel="stylesheet" href="'.$this->config->config['base_url'].'/assets/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.css"/>';

        $data = [
          'user' => $user,
          'user_detail' => $user_detail,
          'salutations' => $this->config->config['gpt_variable']['salutation'],
          'countries' => $this->config->config['gpt_variable']['unsorted_countries'],
          'profile_update_successful' => false,
          'GOOGLE_CAPTCHA_SITE_KEY' => $this->captcha->getSiteKey(),
          'injected_scripts' => implode('',$injectedScripts)
      ];
        if ($this->form_validation->run('hospital_user_profile')) {
            $this->updateHospitalUser($user_detail);
            $data['profile_update_successful'] = true;
        }
        $this->render('myaccount/hospital', $data);
    }

    private function indexProvider(&$user){

        $this->load->library('form_validation');
        $this->load->library('captcha');

        $user_detail = $user->getDetail($this->doctrine->em);
        $injectedScripts[] = $this->captcha->getScript();
        $injectedScripts[] = $this->getScriptTag('/assets/js/provider.js');
        $injectedScripts[] = '<script type="text/javascript" async="" src="'.$this->config->config['base_url'].'/assets/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>';
        $injectedScripts[] = '<link rel="stylesheet" href="'.$this->config->config['base_url'].'/assets/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.css"/>';

        $data = [
          'user' => $user,
          'user_detail' => $user_detail,
          'salutations' => $this->config->config['gpt_variable']['salutation'],
          'countries' => $this->config->config['gpt_variable']['unsorted_countries'],
          'profile_update_successful' => false,
          'GOOGLE_CAPTCHA_SITE_KEY' => $this->captcha->getSiteKey(),
          'injected_scripts' => implode('',$injectedScripts)
      ];
        if ($this->form_validation->run('provider_user_profile')) {
            $this->updateHospitalUser($user_detail);
            $data['profile_update_successful'] = true;
        }
        $this->render('myaccount/provider', $data);
    }
    
    private function indexPatient(&$user)
    {
        $this->load->library('form_validation');
        $this->load->library('captcha');

        $user_detail = $user->getDetail($this->doctrine->em);
        $injectedScripts[] = $this->captcha->getScript();
        $injectedScripts[] = $this->getScriptTag('/assets/js/patient.js');
        $injectedScripts[] = '<script type="text/javascript" async="" src="'.$this->config->config['base_url'].'/assets/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>';
        $injectedScripts[] = '<link rel="stylesheet" href="'.$this->config->config['base_url'].'/assets/vendor/jquery-ui-1.12.1.custom/jquery-ui.min.css"/>';

        $data = [
          'user' => $user,
          'user_detail' => $user_detail,
          'salutations' => $this->config->config['gpt_variable']['salutation'],
          'countries' => $this->config->config['gpt_variable']['unsorted_countries'],
          'relations' => $this->config->config['gpt_variable']['relations'],
          'profile_update_successful' => false,
          'GOOGLE_CAPTCHA_SITE_KEY' => $this->captcha->getSiteKey(),
          'injected_scripts' => implode('',$injectedScripts)
      ];
        if ($this->form_validation->run('patient_profile')) {
            /*if ($user->getEmail() !== $this->input->post('email_address')) {
                $user->setEmail($this->input->post('email_address'));
                $this->doctrine->em->persist($user);
                $this->doctrine->em->flush();
            }*/
            $this->updatePatient($user_detail);
            $data['profile_update_successful'] = true;
        }
        $this->render('myaccount/patient', $data);
    }

    private function updatePatient(&$patient)
    {
        $patient->setSalutation($this->input->post('salutation'));
        $patient->setFirstName($this->input->post('first_name'));
        $patient->setLastName($this->input->post('last_name'));
        $patient->setMiddleName($this->input->post('middle_name'));
        $patient->setDOB($this->input->post('date_of_birth'));
        $patient->setGender($this->input->post('gender'));

        $this->doctrine->em->persist($patient);
        $this->doctrine->em->flush();
    }

    private function updateHospitalUser(&$user)
    {
        $user->setFullName($this->input->post('full_name'));
        $user->setPhoneNo($this->input->post('phone_number'));

        $this->doctrine->em->persist($user);
        $this->doctrine->em->flush();
    }

    private function updateCompanyUser(&$user)
    {
        $user->setFullName($this->input->post('full_name'));
        $user->setPhoneNo($this->input->post('phone_number'));

        $this->doctrine->em->persist($user);
        $this->doctrine->em->flush();
    }

    public function verify_captcha($value)
    {
        if(!$this->captcha->verify($value, $this->input->server('REMOTE_ADDR'))){
            $this->form_validation->set_message('verify_captcha', 'Verify if you are human?');
            return false;
        }
        return true;
    }

    public function ajax(){
        $this->{'callback_'.$this->input->post('action')}();
    }

    private function getHospitalService($id){
        $em = $this->doctrine->em;
        $service = $em->find('GptHospitalServiceXref', $id);
        
        return $service;
      }

    public function json($type, $id){
        $object = null;
        $em = $this->doctrine->em;
        $error = false;

        switch($type){
            case 'patient-email':
                $object = $em->find('GptPatientContactEmail', $id);
            break;

            case 'patient-address':
                $object = $em->find('GptPatientContactAddress', $id);
            break;

            case 'patient-contact':
                $object = $em->find('GptPatientContact', $id);
            break;

            case 'patient-phone':
                $object = $em->find('GptPatientContactPhone', $id);
            break;

            case 'provider-email':
                $object = $em->find('GptCompanyContactEmail', $id);
            break;

            case 'provider-address':
                $object = $em->find('GptCompanyContactAddress', $id);
            break;

            case 'provider-contact':
                $object = $em->find('GptCompanyContact', $id);
            break;

            case 'provider-phone':
                $object = $em->find('GptCompanyContactPhone', $id);
            break;

            case 'provider-service':
                $object = $em->find('GptCompanyService', $id);
            break;

            case 'affiliates':
                $object = $this->hospitalListJson($id);
            break;

            case 'departments':
                $object = $this->departmentListJson();
            break;
            case 'services':
                $object = $this->serviceListJson();
            break;
            case 'service':
                $object = $this->getHospitalService($id);
            break;
            case 'hospital_email':
                $object = $em->find('GptHospitalContactEmail', $id);
            break;

            case 'hospital_address':
                $object = $em->find('GptHospitalContactAddress', $id);
            break;

            case 'hospital_contact':
                $object = $em->find('GptHospitalContact', $id);
            break;

            case 'hospital_phone':
                $object = $em->find('GptHospitalContactPhone', $id);
            break;
        }

        if(!$object) $error = true;
        
        if(!$error){
            $json = (is_array($object))?$object:$object->toJson();
            $this->output_response_success($json);
        } else {
            $this->output_response_failure('Invalid argument provided');
        }
    }

    private function departmentListJson(){
        $em = $this->doctrine->em;
        $departmentRepository = $em->getRepository('GptHospitalDept');
        $departments = $departmentRepository->findBy(array(), array('hospitalDeptName' =>'ASC'));
        $collection = [];

        foreach($departments as $department){
            $collection[] = ['id'=>$department->getId(), 'label'=>$department->getDepartmentName()];
        }
        
        return $collection;
      }

    private function hospitalListJson($id){
        $em = $this->doctrine->em;
        $hospitalRepository = $em->getRepository('GptHospital');
        $hospitals = $hospitalRepository->findBy(array(),array('hospitalName' => 'ASC'));
        $collection = [];

        foreach($hospitals as $hospital){
            $hospital_id = $hospital->getId();
            if($hospital_id == $id) continue;
            $collection[] = ['id'=>$hospital_id, 'label'=>$hospital->getHospitalName()];
        }
        
        return $collection;
    }

    private function output_response_success($html){
        $response = array('success' => TRUE, 'html' => $html);
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    private function output_response_failure($message){
        $response = array('success' => FALSE, 'message' => $message);
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }

    private function callback_patient_contact_add(){

        $em = $this->doctrine->em;

        $contact = new GptPatientContact();
        $contact->setSalutation($this->input->post('salutation'));
        $contact->setFirstName($this->input->post('first_name'));
        $contact->setLastName($this->input->post('last_name'));
        $contact->setMiddleName($this->input->post('middle_name'));
        $contact->setRelation($this->input->post('relation'));
        $patient = $this->getUser()->getDetail($em);
        $contact->setPatient($patient);
        $contact->preCreate();
        $em->persist($contact);
        $em->flush();
        
        $view = $this->load->view('myaccount/patient/partials/display-contact', ['contact' => $contact], true);

        $this->output_response_success($view);
    }

    private function callback_patient_contact_update(){
        $em = $this->doctrine->em;

        $contact = $this->findContact($this->input->post('contact_id'));

        if($contact){
            $contact->setSalutation($this->input->post('salutation'));
            $contact->setFirstName($this->input->post('first_name'));
            $contact->setLastName($this->input->post('last_name'));
            $contact->setMiddleName($this->input->post('middle_name'));
            $contact->setRelation($this->input->post('relation'));
            $em->persist($contact);
            $em->flush();
            $view = $this->load->view('myaccount/patient/partials/display-contact', ['contact' => $contact], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_hospital_affiliate_attach(){
        $em = $this->doctrine->em;
        $hospital = $em->find('GptHospital', $this->input->post('hospital_id'));
        $affiliate = $em->find('GptHospital', $this->input->post('affiliate_id'));
        $hospital->addAffiliate($affiliate);
        $em->persist($hospital);
        $em->flush();
        $view = $this->load->view('myaccount/hospital/partials/display-affiliate', ['affiliate' => $affiliate], true);
        $this->output_response_success($view);
    }

    private function callback_hospital_affiliate_detach(){
        $em = $this->doctrine->em;
        $hospital = $em->find('GptHospital', $this->input->post('hospital_id'));
        $affiliate = $em->find('GptHospital', $this->input->post('affiliate_hospital_id'));
        $hospital->getAffiliates()->removeElement($affiliate);
        $em->persist($hospital);
        $em->flush();
        $this->output_response_success('');
    }

    private function callback_patient_contact_address_add(){
        $em = $this->doctrine->em;

        $address = new GptPatientContactAddress();
        $address->setAddress([
            'streetAddr1' => $this->input->post('street_add_1'),
            'streetAddr2' => $this->input->post('street_add_2'),
            'streetAddr3' => $this->input->post('street_add_3'),
            'zipcode' => $this->input->post('zipcode'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country')
        ]);
        $contact = $this->findContact($this->input->post('contact_id'));
        if($contact){
            $address->setContact($contact);
            $address->preCreate();
            $em->persist($address);
            $em->flush();
            $view = $this->load->view('myaccount/patient/partials/display-address', ['address' => $address], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_patient_contact_address_update(){

        $em = $this->doctrine->em;
        $contact = $this->findContact($this->input->post('contact_id'));

        if($contact){
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("addressId", $this->input->post('address_id')));
            $addresses = $contact->getAddresses();
            $address = $addresses->matching($criteria)->get(0);
            if($address){
                $address->setAddress([
                    'streetAddr1' => $this->input->post('street_add_1'),
                    'streetAddr2' => $this->input->post('street_add_2'),
                    'streetAddr3' => $this->input->post('street_add_3'),
                    'zipcode' => $this->input->post('zipcode'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'country' => $this->input->post('country')
                ]);
                $em->persist($address);
                $em->flush();
                $view = $this->load->view('myaccount/patient/partials/display-address', ['address' => $address], true);
                $this->output_response_success($view);
            }else{
                $this->output_response_failure('Invalid arguments provided');
            }
        }
    }

    private function callback_patient_contact_phone_number_add(){

        $em = $this->doctrine->em;
        $phone_number = new GptPatientContactPhone();
        $phone_number->setPhone([
            'ctryCd' => $this->input->post('ctry_cd'),
            'areaCd' => $this->input->post('area_cd'),
            'phoneNo' => $this->input->post('phone_no'),
            'extension' => $this->input->post('ext')
        ]);
        $contact = $this->findContact($this->input->post('contact_id'));
        
        if($contact){
            $phone_number->setContact($contact);
            $phone_number->preCreate();
            $em->persist($phone_number);
            $em->flush();
            $view = $this->load->view('myaccount/patient/partials/display-phone', ['phone_number' => $phone_number], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_patient_contact_phone_number_update(){
        $em = $this->doctrine->em;
        $contact = $this->findContact($this->input->post('contact_id'));

        if($contact){
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("phoneId", $this->input->post('phone_id')));
            $phone_numbers = $contact->getPhoneNumbers();
            $phone_number = $phone_numbers->matching($criteria)->get(0);
            if($phone_number){
                $phone_number->setPhone([
                    'ctryCd' => $this->input->post('ctry_cd'),
                    'areaCd' => $this->input->post('area_cd'),
                    'phoneNo' => $this->input->post('phone_no'),
                    'extension' => $this->input->post('ext')
                ]);
                $em->persist($phone_number);
                $em->flush();
                $view = $this->load->view('myaccount/patient/partials/display-phone', ['phone_number' => $phone_number], true);
                $this->output_response_success($view);
            }else{
                $this->output_response_failure('Invalid arguments provided');
            }
        }
    }

    private function findContact($contact_id) {
        $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("patientContId", $contact_id));
        $contacts = $this->getUser()->getDetail($this->doctrine->em)->getContacts();
        $contact = $contacts->matching($criteria)->get(0);
        return $contact;
    }

    private function callback_patient_contact_email_address_add(){

        $em = $this->doctrine->em;
        $email = new GptPatientContactEmail();
        $email->setEmail($this->input->post('email_address'));
        $contact = $this->findContact($this->input->post('contact_id'));

        if($contact){
            $email->setContact($contact);
            $email->preCreate();
            $em->persist($email);
            $em->flush();
            $view = $this->load->view('myaccount/patient/partials/display-email', ['email' => $email], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_patient_contact_email_address_update(){

        $em = $this->doctrine->em;
        $contact = $this->findContact($this->input->post('contact_id'));

        if($contact){
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("emailId", $this->input->post('email_id')));
            $emails = $contact->getEmails();
            $email = $emails->matching($criteria)->get(0);
            if($email){
                $email->setEmail($this->input->post('email_address'));
                $em->persist($email);
                $em->flush();
                $view = $this->load->view('myaccount/patient/partials/display-email', ['email' => $email], true);
                $this->output_response_success($view);
            }else{
                $this->output_response_failure('Invalid arguments provided');
            }
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_patient_contact_address_delete(){
        $em = $this->doctrine->em;
        $address = $em->find('GptPatientContactAddress', $this->input->post('address_id'));
        if($address){
            $em->remove($address);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_patient_contact_email_delete(){
        $em = $this->doctrine->em;
        $email = $em->find('GptPatientContactEmail', $this->input->post('email_id'));
        if($email){
            $em->remove($email);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_patient_contact_delete(){
        $em = $this->doctrine->em;
        $contact = $em->find('GptPatientContact', $this->input->post('contact_id'));
        if($contact){
            $em->remove($contact);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_patient_contact_phone_delete(){
        $em = $this->doctrine->em;
        $phone = $em->find('GptPatientContactPhone', $this->input->post('phone_id'));
        if($phone){
            $em->remove($phone);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_mark_favorite(){
        $em = $this->doctrine->em;
        $patient = $this->getUser()->getDetail($em);
        $reference_id = $this->input->post('reference_id');
        $type = $this->input->post('type');

        $favorite = new GptPatientFavorite();
        $favorite->setType($type);
        $favorite->setReferenceId($reference_id);
        $favorite->setPatient($patient);
        $em->persist($favorite);
        $em->flush();

        $this->output_response_success('');
        
    }

    private function callback_unmark_favorite(){
        $em = $this->doctrine->em;
        $patient = $this->getUser()->getDetail($em);

        $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("referenceId", $this->input->post('reference_id')))
                    ->andWhere(Criteria::expr()->eq("type", $this->input->post('type')));
        $favorites = $patient->getFavorites();
        $favorite = $favorites->matching($criteria)->get(0);
        if($favorite){
            $em->remove($favorite);
            $em->flush();
        }
        $this->output_response_success('');
    }   
    
    


    /************************************/
    /** PROVIDER CONTACTS              **/
    /************************************/

    private function findCompanyContact($contact_id) {
        $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("contId", $contact_id));
        $contacts = $this->getUser()->getDetail($this->doctrine->em)->getCompany()->getContacts();
        $contact = $contacts->matching($criteria)->get(0);
        return $contact;
    }

    private function callback_provider_contact_add(){

        $em = $this->doctrine->em;

        $user = $this->getUser();
        $company = $user->getDetail($em)->getCompany();

        $contact = new GptCompanyContact();
        $contact->setSalutation($this->input->post('salutation'));
        $contact->setFirstName($this->input->post('first_name'));
        $contact->setLastName($this->input->post('last_name'));
        $contact->setMiddleName($this->input->post('middle_name'));
        $contact->setJobTitle($this->input->post('job_title'));
        $contact->setJobFunction($this->input->post('job_function'));
        $contact->setJobRole($this->input->post('job_role'));
        $contact->setCompany($company);
        $contact->preCreate();
        $em->persist($contact);
        $em->flush();
        
        $view = $this->load->view('myaccount/provider/partials/display-contact', ['contact' => $contact], true);

        $this->output_response_success($view);
    }

    private function callback_provider_contact_update(){
        $em = $this->doctrine->em;

        $contact = $this->findCompanyContact($this->input->post('contact_id'));

        if($contact){
            $contact->setSalutation($this->input->post('salutation'));
            $contact->setFirstName($this->input->post('first_name'));
            $contact->setLastName($this->input->post('last_name'));
            $contact->setMiddleName($this->input->post('middle_name'));
            $contact->setJobFunction($this->input->post('job_function'));
            $contact->setJobRole($this->input->post('job_role'));
            $em->persist($contact);
            $em->flush();
            $view = $this->load->view('myaccount/provider/partials/display-contact', ['contact' => $contact], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_provider_contact_delete(){
        $em = $this->doctrine->em;
        $contact = $em->find('GptCompanyContact', $this->input->post('contact_id'));
        if($contact){
            $em->remove($contact);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_provider_contact_address_add(){
        $em = $this->doctrine->em;

        $address = new GptCompanyContactAddress();
        $address->setAddress([
            'streetAddr1' => $this->input->post('street_add_1'),
            'streetAddr2' => $this->input->post('street_add_2'),
            'streetAddr3' => $this->input->post('street_add_3'),
            'zipcode' => $this->input->post('zipcode'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country')
        ]);
        $contact = $this->findCompanyContact($this->input->post('contact_id'));
        if($contact){
            $address->setContact($contact);
            $address->preCreate();
            $em->persist($address);
            $em->flush();
            $view = $this->load->view('myaccount/provider/partials/display-address', ['address' => $address], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_provider_contact_address_update(){

        $em = $this->doctrine->em;
        $contact = $this->findCompanyContact($this->input->post('contact_id'));

        if($contact){
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("addressId", $this->input->post('address_id')));
            $addresses = $contact->getAddresses();
            $address = $addresses->matching($criteria)->get(0);
            if($address){
                $address->setAddress([
                    'streetAddr1' => $this->input->post('street_add_1'),
                    'streetAddr2' => $this->input->post('street_add_2'),
                    'streetAddr3' => $this->input->post('street_add_3'),
                    'zipcode' => $this->input->post('zipcode'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'country' => $this->input->post('country')
                ]);
                $em->persist($address);
                $em->flush();
                $view = $this->load->view('myaccount/provider/partials/display-address', ['address' => $address], true);
                $this->output_response_success($view);
            }else{
                $this->output_response_failure('Invalid arguments provided');
            }
        }
    }

    private function callback_provider_contact_phone_number_add(){

        $em = $this->doctrine->em;
        $phone_number = new GptCompanyContactPhone();
        $phone_number->setPhone([
            'ctryCd' => $this->input->post('ctry_cd'),
            'areaCd' => $this->input->post('area_cd'),
            'phoneNo' => $this->input->post('phone_no'),
            'extension' => $this->input->post('ext')
        ]);
        $contact = $this->findCompanyContact($this->input->post('contact_id'));
        
        if($contact){
            $phone_number->setContact($contact);
            $phone_number->preCreate();
            $em->persist($phone_number);
            $em->flush();
            $view = $this->load->view('myaccount/provider/partials/display-phone', ['phone_number' => $phone_number], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_provider_contact_phone_number_update(){
        $em = $this->doctrine->em;
        $contact = $this->findCompanyContact($this->input->post('contact_id'));

        if($contact){
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("phoneId", $this->input->post('phone_id')));
            $phone_numbers = $contact->getPhoneNumbers();
            $phone_number = $phone_numbers->matching($criteria)->get(0);
            if($phone_number){
                $phone_number->setPhone([
                    'ctryCd' => $this->input->post('ctry_cd'),
                    'areaCd' => $this->input->post('area_cd'),
                    'phoneNo' => $this->input->post('phone_no'),
                    'extension' => $this->input->post('ext')
                ]);
                $em->persist($phone_number);
                $em->flush();
                $view = $this->load->view('myaccount/provider/partials/display-phone', ['phone_number' => $phone_number], true);
                $this->output_response_success($view);
            }else{
                $this->output_response_failure('Invalid arguments provided');
            }
        }
    }

    private function callback_provider_contact_email_address_add(){

        $em = $this->doctrine->em;
        $email = new GptCompanyContactEmail();
        $email->setEmail($this->input->post('email_address'));
        $contact = $this->findCompanyContact($this->input->post('contact_id'));

        if($contact){
            $email->setContact($contact);
            $email->preCreate();
            $em->persist($email);
            $em->flush();
            $view = $this->load->view('myaccount/provider/partials/display-email', ['email' => $email], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_provider_contact_email_address_update(){

        $em = $this->doctrine->em;
        $contact = $this->findCompanyContact($this->input->post('contact_id'));

        if($contact){
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("emailId", $this->input->post('email_id')));
            $emails = $contact->getEmails();
            $email = $emails->matching($criteria)->get(0);
            if($email){
                $email->setEmail($this->input->post('email_address'));
                $em->persist($email);
                $em->flush();
                $view = $this->load->view('myaccount/provider/partials/display-email', ['email' => $email], true);
                $this->output_response_success($view);
            }else{
                $this->output_response_failure('Invalid arguments provided');
            }
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_provider_contact_address_delete(){
        $em = $this->doctrine->em;
        $address = $em->find('GptCompanyContactAddress', $this->input->post('address_id'));
        if($address){
            $em->remove($address);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_provider_contact_email_delete(){
        $em = $this->doctrine->em;
        $email = $em->find('GptCompanyContactEmail', $this->input->post('email_id'));
        if($email){
            $em->remove($email);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_provider_contact_phone_delete(){
        $em = $this->doctrine->em;
        $phone = $em->find('GptCompanyContactPhone', $this->input->post('phone_id'));
        if($phone){
            $em->remove($phone);
            $em->flush();
        }
        $this->output_response_success('');
    }

    /************************************/
    /** PROVIDER CONTACTS END          **/
    /************************************/

    /************************************/
    /** PROVIDER SERVICES              **/
    /************************************/

    private function callback_provider_service_add(){

        $em = $this->doctrine->em;
        $service = new GptCompanyService();
        $service->setServiceName($this->input->post('service_name'));
        $service->setCategory($this->input->post('service_category'));
        $service->setSubCategory($this->input->post('service_sub_category'));
        $service->setMinPrice($this->input->post('min_price'));
        $service->setMaxPrice($this->input->post('max_price'));
        $service->setComments($this->input->post('comments'));

        $user = $this->getUser();
        $company = $user->getDetail($em)->getCompany();

        if($company){
            $service->setCompany($company);
            $service->preCreate();
            $em->persist($service);
            $em->flush();
            $view = $this->load->view('myaccount/provider/partials/display-service', ['service' => $service], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_provider_service_delete(){
        $em = $this->doctrine->em;
        $service = $em->find('GptCompanyService', $this->input->post('service_id'));
        if($service){
            $em->remove($service);
            $em->flush();
        }
        $this->output_response_success('');
    }
    
    private function callback_provider_service_update(){
        $em = $this->doctrine->em;

        $service = $em->find('GptCompanyService', $this->input->post('service_id'));

        if($service){
            $service->setServiceName($this->input->post('service_name'));
            $service->setCategory($this->input->post('service_category'));
            $service->setSubCategory($this->input->post('service_sub_category'));
            $service->setMinPrice($this->input->post('min_price'));
            $service->setMaxPrice($this->input->post('max_price'));
            $service->setComments($this->input->post('comments'));
            $em->persist($service);
            $em->flush();
            $view = $this->load->view('myaccount/provider/partials/display-service', ['service' => $service], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }
    /************************************/
    /** PROVIDER SERVICES END          **/
    /************************************/

    private function callback_hospital_department_attach(){
        $em = $this->doctrine->em;
        $hospital = $em->find('GptHospital', $this->input->post('hospital_id'));
        $department_id = $this->input->post('department_id');

        if($department_id == 'add_new'){
            $department_name = $this->input->post('department_name');
            $department = $em->getRepository('GptHospitalDept')->findOneBy(array('hospitalDeptName' => $department_name));
            if(!$department){
                $department = new GptHospitalDept();
                $department->setDepartmentName($department_name);
                $department->preCreate();
                $em->persist($department);
                $em->flush();
            }
        }else{
            $department = $em->find('GptHospitalDept', $department_id);
        }

        $hospital->addDepartment($department);
        $em->persist($hospital);
        $em->flush();
        $view = $this->load->view('myaccount/hospital/partials/display-department', ['department' => $department, 'hospital' => $hospital], true);
        $this->output_response_success($view);
    }

    private function callback_hospital_department_detach(){
        $em = $this->doctrine->em;
        $hospital = $em->find('GptHospital', $this->input->post('hospital_id'));
        $department = $em->find('GptHospitalDept', $this->input->post('hospital_dept_id'));
        
        $contReferences = $em->getRepository('GptHospitalContXref')->findAll();
        $serviceReferences = $em->getRepository('GptHospitalServiceXref')->findAll();
        
        $contReferencesCount = 0;
        foreach ($contReferences as $contact) {
            if($contact->getDepartment()->getId() == $department->getId()
                    && $contact->getHospital()->getId() == $hospital->getId()){
                        ++$contReferencesCount;
                    }
        }
        
        $serviceReferencesCount = 0;
        foreach ($serviceReferences as $service) {
            if ($service->getDepartment()->getId() == $department->getId()
                    && $service->getHospital()->getId() == $hospital->getId()){
                        ++$serviceReferencesCount;
                    }
        }

        if($serviceReferencesCount == 0 && $contReferencesCount == 0){
            $hospital->getDepartments()->removeElement($department);
            $em->persist($hospital);
            $em->flush();
            $this->output_response_success('');
        }else{
            $this->output_response_failure('Department has other associations. Please remove them first.');
        }
        
    }

    private function callback_hospital_service_detach(){
        $em = $this->doctrine->em;
        $service = $em->find('GptHospitalServiceXref', $this->input->post('service_id'));
        
        if($service){
            $em->remove($service);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function serviceListJson(){
        $em = $this->doctrine->em;
        $serviceRepository = $em->getRepository('GptHospitalService');
        $services = $serviceRepository->findBy(array(), array('serviceName'=>'ASC'));
        $collection = [];

        foreach($services as $service){
            $collection[] = ['id'=>$service->getId(), 'label'=>$service->getServiceName()];
        }
        
        return $collection;
      }

      private function callback_hospital_service_attach(){
        $em = $this->doctrine->em;
        $hospital = $em->find('GptHospital', $this->input->post('hospital_id'));
        $department = $em->find('GptHospitalDept', $this->input->post('department_id'));
        $service_id = $this->input->post('service_id');

        if($service_id == 'add_new'){
            $service_name = $this->input->post('service_name');
            $service_category = $this->input->post('service_category');
            $service_sub_category = $this->input->post('service_sub_category');
            
            $service = $em->getRepository('GptHospitalService')->findOneBy(array('serviceName' => $service_name, 'serviceCategory' => $service_category, 'serviceSubCategory' => $service_sub_category));
            
            if(!$service){
                $service = new GptHospitalService();
                $service->setServiceName($service_name);
                $service->setCategory($service_category);
                $service->setSubCategory($service_sub_category);
                $service->preCreate();
                $em->persist($service);
                $em->flush();
            }
        }else{
            $service = $em->find('GptHospitalService', $service_id);
        }

        $xref = new GptHospitalServiceXref();
        $xref->setDepartment($department);
        $xref->setHospital($hospital);
        $xref->setService($service);
        $xref->setMinPrice($this->input->post('min_price'));
        $xref->setMaxPrice($this->input->post('max_price'));
        $xref->setComments($this->input->post('comments'));
        $xref->preCreate();
        $em->persist($xref);
        $em->flush();
        $view = $this->load->view('myaccount/hospital/partials/display-service', ['service' => $xref], true);
        $this->output_response_success($view);
    }

    private function callback_hospital_service_update(){
        $em = $this->doctrine->em;

        $xref = $em->find('GptHospitalServiceXref', $this->input->post('hs_id'));
        $xref->setMinPrice($this->input->post('min_price'));
        $xref->setMaxPrice($this->input->post('max_price'));
        $xref->setComments($this->input->post('comments'));
        $em->persist($xref);
        $em->flush();
        $view = $this->load->view('myaccount/hospital/partials/display-service', ['service' => $xref], true);
        $this->output_response_success($view);
    }

    private function callback_hospital_contact_detach(){
        $em = $this->doctrine->em;
        $contact = $em->find('GptHospitalContXref', $this->input->post('contact_id'));
        
        if($contact){
           
            $em->remove($contact);
            $em->flush();
        }else{
            var_dump($this->input->post('contact_id'));
            die("Error");
        }
        $this->output_response_success('');
    }

    private function callback_hospital_contact_add(){

        $em = $this->doctrine->em;

        $hospital = $em->find('GptHospital', $this->input->post('hospital_id'));
        $department = $em->find('GptHospitalDept', $this->input->post('department_id'));

        $contact = new GptHospitalContact();
        $contact->setSalutation($this->input->post('salutation'));
        $contact->setFirstName($this->input->post('first_name'));
        $contact->setLastName($this->input->post('last_name'));
        $contact->setMiddleName($this->input->post('middle_name'));
        $contact->setJobTitle($this->input->post('job_title'));
        $contact->setJobFunction($this->input->post('job_function'));
        $contact->setJobRole($this->input->post('job_role'));
        $contact->preCreate();
        $em->persist($contact);
        $em->flush();

        $xref = new GptHospitalContXref();
        $xref->setDepartment($department);
        $xref->setHospital($hospital);
        $xref->setContact($contact);
        $xref->preCreate();
        $em->persist($xref);
        $em->flush();
        $view = $this->load->view('myaccount/hospital/partials/display-contact', ['xref' => $xref], true);
        $this->output_response_success($view);
    }

    private function callback_hospital_contact_update(){

        $em = $this->doctrine->em;

        $xref = $em->find('GptHospitalContXref', $this->input->post('xref_id'));
        $contact = $xref->getContact();
        $contact->setSalutation($this->input->post('salutation'));
        $contact->setFirstName($this->input->post('first_name'));
        $contact->setLastName($this->input->post('last_name'));
        $contact->setMiddleName($this->input->post('middle_name'));
        $contact->setJobTitle($this->input->post('job_title'));
        $contact->setJobFunction($this->input->post('job_function'));
        $contact->setJobRole($this->input->post('job_role'));
        $em->persist($contact);
        $em->flush();
        $view = $this->load->view('myaccount/hospital/partials/display-contact', ['xref' => $xref], true);
        $this->output_response_success($view);
    }

    private function callback_hospital_contact_address_add(){
        $em = $this->doctrine->em;

        $xref = $em->find('GptHospitalContXref', $this->input->post('xref_id'));
        $contact = $xref->getContact();

        $address = new GptHospitalContactAddress();
        $address->setAddress([
            'streetAddr1' => $this->input->post('street_add_1'),
            'streetAddr2' => $this->input->post('street_add_2'),
            'streetAddr3' => $this->input->post('street_add_3'),
            'zipcode' => $this->input->post('zipcode'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country')
        ]);
        
        if($contact){
            $address->setContact($contact);
            $address->preCreate();
            $em->persist($address);
            $em->flush();
            $view = $this->load->view('myaccount/hospital/partials/display-address', ['address' => $address], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }
    

    private function callback_hospital_contact_phone_number_add(){

        $em = $this->doctrine->em;
        $xref = $em->find('GptHospitalContXref', $this->input->post('xref_id'));
        $contact = $xref->getContact();

        $phone_number = new GptHospitalContactPhone();
        $phone_number->setPhone([
            'ctryCd' => $this->input->post('ctry_cd'),
            'areaCd' => $this->input->post('area_cd'),
            'phoneNo' => $this->input->post('phone_no'),
            'extension' => $this->input->post('ext')
        ]);
        
        
        if($contact){
            $phone_number->setContact($contact);
            $phone_number->preCreate();
            $em->persist($phone_number);
            $em->flush();
            $view = $this->load->view('myaccount/hospital/partials/display-phone', ['phone_number' => $phone_number], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }


    private function callback_hospital_contact_email_address_add(){

        $em = $this->doctrine->em;
        $xref = $em->find('GptHospitalContXref', $this->input->post('xref_id'));
        $contact = $xref->getContact();

        $email = new GptHospitalContactEmail();
        $email->setEmail($this->input->post('email_address'));
        

        if($contact){
            $email->setContact($contact);
            $email->preCreate();
            $em->persist($email);
            $em->flush();
            $view = $this->load->view('myaccount/hospital/partials/display-email', ['email' => $email], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    

    private function callback_hospital_contact_address_delete(){
        $em = $this->doctrine->em;
        $address = $em->find('GptHospitalContactAddress', $this->input->post('address_id'));
        if($address){
            $em->remove($address);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_hospital_contact_email_delete(){
        $em = $this->doctrine->em;
        $email = $em->find('GptHospitalContactEmail', $this->input->post('email_id'));
        if($email){
            $em->remove($email);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_hospital_contact_phone_delete(){
        $em = $this->doctrine->em;
        $phone = $em->find('GptHospitalContactPhone', $this->input->post('phone_id'));
        if($phone){
            $em->remove($phone);
            $em->flush();
        }
        $this->output_response_success('');
    }

    private function callback_hospital_contact_email_address_update(){

        $em = $this->doctrine->em;
        $email = $em->find('GptHospitalContactEmail' ,$this->input->post('email_id'));
        if($email){
            $email->setEmail($this->input->post('email_address'));
            $em->persist($email);
            $em->flush();
            $view = $this->load->view('myaccount/hospital/partials/display-email', ['email' => $email], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_hospital_contact_phone_number_update(){

        $em = $this->doctrine->em;
        $phone_number = $em->find('GptHospitalContactPhone' ,$this->input->post('phone_id'));
        if($phone_number){
            $phone_number->setPhone([
                'ctryCd' => $this->input->post('ctry_cd'),
                'areaCd' => $this->input->post('area_cd'),
                'phoneNo' => $this->input->post('phone_no'),
                'extension' => $this->input->post('ext')
            ]);
            $em->persist($phone_number);
            $em->flush();
            $view = $this->load->view('myaccount/hospital/partials/display-phone', ['phone_number' => $phone_number], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }

    private function callback_hospital_contact_address_update(){

        $em = $this->doctrine->em;

        $address = $em->find('GptHospitalContactAddress' ,$this->input->post('address_id'));
        if($address){
            $address->setAddress([
                'streetAddr1' => $this->input->post('street_add_1'),
                'streetAddr2' => $this->input->post('street_add_2'),
                'streetAddr3' => $this->input->post('street_add_3'),
                'zipcode' => $this->input->post('zipcode'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country')
            ]);
            $em->persist($address);
            $em->flush();
            $view = $this->load->view('myaccount/hospital/partials/display-address', ['address' => $address], true);
            $this->output_response_success($view);
        }else{
            $this->output_response_failure('Invalid arguments provided');
        }
    }
    
}