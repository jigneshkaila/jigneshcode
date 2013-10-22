<?php

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("wp_post");
    }

    public function index() {
        $config = array();
        $this->load->view("contact");
    }

}

?>
