<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'controllers/Authenticated_Controller.php';

class Search_Controller extends Public_Controller
{
    public function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('counters');

        $keyword = $this->input->get('s');
        $selected_country = $this->input->get('c');
        $selected_department = $this->input->get('d');

        $this->saveKeyword($keyword, $selected_country, $selected_department);
        $serviceProviders = $this->searchServiceProvider($keyword, $selected_country);
        $hospitals = $this->searchHospital($keyword, $selected_country, $selected_department);
        $favoriteEntities = $this->getFavorites();

        $results = ['hospitals' => [], 'serviceProviders' => []];

        foreach($hospitals as $hospital){
            $h = [   'id'=> $hospital->getId(),
                            'name' => $hospital->getHospitalName(),
                            'url' => $hospital->getHospitalUrl(),
                            'departments' => []];
            $departments = $hospital->getDepartments();
            
            foreach($departments as $department){
                $d = [
                    'name' => $department->getDepartmentName(),
                    'services' => [],
                    'location' => []
                ];
                $xrefs = $this->getDepartmentServices($hospital, $department);
                foreach($xrefs as $xref){
                    $service = $xref->getService();
                    $minPrice = $xref->getMinPrice();
                    $maxPrice = $xref->getMaxPrice();
                    $d['services'][] = (object) array('service_name' => $service->getServiceName(), 'min_price' => $minPrice, 'max_price' => $maxPrice);
                }
                
                $contacts = $this->getDepartmentContact($hospital, $department);
                foreach($contacts as $contact){
                    $addresses = $contact->getAddresses();
                    foreach($addresses as $address){
                        $d['location'][] = $address->getAddress();
                    }
                }
                $h['departments'][] = $d;
            }
            $results['hospitals'][] = $h;
        }
        
        $injectedScripts[] = $this->getScriptTag('/assets/js/search.js');

        $this->render(  'search/search', [
            'serviceProviders' => $serviceProviders,
            'hospitals' => $results['hospitals'],
            'injected_scripts' => implode('',$injectedScripts),
            'favoriteEntities' => $favoriteEntities,
            'keyword' => $keyword,
            'selected_country' => $selected_country,
            'selected_department' => $selected_department,
            'counters' => [
                'count_most_searched_countries',
                'count_most_searched_departments',
                'count_most_searched_keywords',
                'count_most_liked_hospitals',
                'count_service_providers',
                'count_most_liked_service_provider'
            ]
        ]);
    }

    private function getDepartmentServices($hospital, $department){

        $repository = $this->doctrine->em->getRepository('GptHospitalServiceXref');

        $xref =  $repository->findBy([
                    'hospital' => $hospital,
                    'department' => $department
                  ]);
        return $xref;
    }

    private function getDepartmentContact($hospital, $department){
        $repository = $this->doctrine->em->getRepository('GptHospitalContXref');

        $xrefs =  $repository->findBy([
                    'hospital' => $hospital,
                    'hospitalDept' => $department
                  ]);
        $contacts = [];
        foreach($xrefs as $xref){
            $contacts[] = $xref->getContact();
        }
        return $contacts;
    }

    private function searchServiceProvider($keyword, $country) {
        $query = $this->doctrine->em->createQueryBuilder()
                    ->select('c')
                    ->from('GptCompany', 'c')
                    ->leftJoin('c.contacts', 'cc')
                    ->leftJoin('c.services', 's')
                    ->leftJoin('cc.addresses', 'a');


        if($country !== ''){
            $query->where('a.country = :country')->setParameter('country',$country);
        }
        $query = $query->orderBy('c.companyName', 'ASC')->getQuery();
        return $query->getResult();
    }

    private function searchHospital($keyword, $country, $department) {
        $query = $this->doctrine->em->createQueryBuilder()
                    ->select('h')
                    ->from('GptHospital', 'h')
                    ->leftJoin('h.departments', 'd')
                    ->leftJoin('GptHospitalServiceXref', 'xs', 'WITH','xs.hospital = h AND xs.department = d')
                    ->leftJoin('xs.service', 's')
                    ->leftJoin('GptHospitalContXref', 'xc', 'WITH','xc.hospital = h AND xc.hospitalDept = d')
                    ->leftJoin('xc.cont', 'c')
                    ->leftJoin('c.addresses', 'a');
    $keywordWhere = 'h.hospitalName LIKE :keyword
                    OR h.hospitalType LIKE :keyword
                    or h.hospitalUrl LIKE :keyword
                    or a.streetAddr1 LIKE :keyword
                    or a.streetAddr2 LIKE :keyword
                    or a.streetAddr3 LIKE :keyword
                    or a.city LIKE :keyword
                    or a.state LIKE :keyword
                    or s.serviceName LIKE :keyword
                    or s.serviceCategory LIKE :keyword
                    or s.serviceSubCategory LIKE :keyword';
    if($country == '' && $department == ''){ // both are empty
        $keywordWhere .= ' or a.country LIKE :keyword or d.hospitalDeptName LIKE :keyword';
        $query->where($keywordWhere);
    }elseif($country == ''){ // department is selected
        $keywordWhere .= ' or a.country LIKE :keyword';
        $query->where($keywordWhere)->andWhere('d.hospitalDeptName = :department')->setParameter('department',$department);
    }elseif($department == ''){ //country is selected
        $keywordWhere .= ' or d.hospitalDeptName LIKE :keyword';
        $query->where($keywordWhere)->andWhere('a.country = :country')->setParameter('country',$country);
    }else{ //both are selected
        $query->where($keywordWhere);
        $query->where($keywordWhere)
                ->andWhere('a.country = :country')->setParameter('country',$country)
                ->andWhere('d.hospitalDeptName = :department')->setParameter('department',$department);;
    }
    $query = $query->orderBy('h.hospitalName', 'ASC');
    $query = $query->setParameter('keyword', '%'.$keyword.'%')->getQuery();
    
        return $query->getResult();
    }

    private function saveKeyword($keyword, $country, $department) {
        $em = $this->doctrine->em;
        $object = new GptSearchKeyword();
        $object->setKeyword($keyword);
        $object->setCountry($country);
        $object->setDepartment($department);
        
        if($this->isLoggedIn()){
            $object->setUserId($this->getUser()->getId());
        }else{
            $object->setUserId(session_id());
        }
        
        $em->persist($object);
        $em->flush();
    }

    private function getFavorites() {
        
        if($this->isLoggedIn() && GptUser::USER_ROLE_PATIENT == $this->getUser()->getRole()){
            $em = $this->doctrine->em;
            $patient = $this->getUser()->getDetail($this->doctrine->em);
            $collection = [];
            foreach($patient->getFavorites() as $favorite) {
                $collection[] = ['id' => $favorite->getReferenceId(), 'type' => $favorite->getType()];
            }
            return $collection;
        }
        return [];
    }

}
