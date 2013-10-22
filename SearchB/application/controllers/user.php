<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("wp_post");
    }

    public function index() {
        
    }

    public function Register() {
        $this->load->view('register');
    }

}

?>
