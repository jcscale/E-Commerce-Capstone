<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboards extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('user_id')) {
            redirect("/");
        }
    }

    public function index() {
        $this->load->view('templates/header.php');
        $this->load->view('dashboards/dashboard');
        $this->load->view('templates/footer.php');
    }
}


?>