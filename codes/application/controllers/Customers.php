<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Customers extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("pagination");
        if(!$this->session->userdata('user_id')) {
            redirect("/");
        }
    }
    
    public function index() {

        $data['products'] = $this->customer->get_all_products();
        $data['categories'] = $this->customer->fetch_all_categories();

        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/customer', $data);
        $this->load->view('templates/footer');
    }

    public function show($id) {
        $data['product'] = $this->customer->product_detail($id);
        $data['images'] = $this->customer->fetch_images($id);
        // var_dump($data['images']);
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/product_detail', $data);
        $this->load->view('templates/footer');

    }
}







?>