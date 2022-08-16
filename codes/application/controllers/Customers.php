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
        // var_dump($data);
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/product_detail', $data);
        $this->load->view('templates/footer');

    }

    public function cart() {
        $data['temp_orders'] = $this->customer->get_user_temp_orders();
        $data['total_temp_price'] = $this->customer->get_total_temp_order_price();
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/cart', $data);
        $this->load->view('templates/footer');
    }

    public function temp_orders () {
        $cart = $this->input->post();
        $id = $this->customer->product_detail($cart['product_id']);
        // var_dump($cart);
        // var_dump($id);
        echo($this->session->userdata('user_id'));

        $temp_order = array(
            'product_id' => $id['id'],
            'name' => $id['name'],
            'price' => $id['price'],
            'quantity' => $cart['quantity'],
            'total_price' =>$cart['quantity'] * $id['price'],
            'users_id' => $this->session->userdata('user_id'),
        );

        $this->customer->insert_to_temp_order($temp_order);
        redirect('customers/show/'.$id['id']);
    }

    public function delete_temp_order($id) {
        $this->customer->delete_temp_order($id);
        redirect('customers/cart');
    }

    public function ship_bill_info() {
        $data = $this->input->post();
        var_dump($data);
    }

}







?>