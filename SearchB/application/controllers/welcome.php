<?php

class Welcome extends CI_Controller {

    public function __construct() {
        parent:: __construct();
      
    }

    public function CityName($state_name) {
        $data["results"] = $this->data->findCityNameByStaeName();
        $this->load->view("GetCityNameByStateName", $data);
    }

    public function index() {
        //$this->output->cache(10);
        $this->load->view("welcome_message");
    }
    

}
