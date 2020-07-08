<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page_Controller extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('counters');
    }

    public function index()
    {
        $this->render('home', ['counters' => [
            'count_countries_serviced',
            'count_cities_serviced',
            'count_patients',
            'count_hospitals',
            'count_hospital_services',
            'count_service_providers'
        ]]);
    }

    public function aboutUs()
    {
        $this->render('about-us', ['counters' => [
            'count_patients_by_city',
            'count_patients_by_country',
            'count_hospital_services',
            'lowest_priced_hospital_service',
            'highest_priced_hospital_service',
            'count_service_providers'
        ]]);
    }

    public function services()
    {
        $this->render('services', ['counters' => [
            'count_patients',
            'count_service_providers',
            'count_most_liked_service_provider',
            'count_service_provider_services',
            'lowest_priced_service_provider_service',
            'highest_priced_service_provider_service'
        ]]);
    }

    public function patients()
    {
        $this->render('patients', ['counters' => [
            'count_countries_serviced',
            'count_most_searched_countries',
            'count_most_hospitals_by_country',
            'count_most_searched_departments',
            'count_most_searched_keywords',
            'count_cities_serviced'
        ]]);
    }

    public function contactUs()
    {
        $this->render('');
    }
    
     public function privacy()
    {
        $this->render('privacy');
    }

    public function terms()
    {
        $this->render('terms');
    }
}
