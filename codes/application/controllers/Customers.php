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

        if(!empty($this->customer->count_user_temp_order())) {
            $this->session->set_userdata('user_temp_orders', $this->customer->count_user_temp_order());
        }
    
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/customer', $data);
        $this->load->view('templates/footer');
    }

    public function setting() {
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/setting');
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
        $data['shipping'] = $this->customer->get_shipping_info($this->session->userdata('user_id'));
        $data['billing'] = $this->customer->get_billing_info($this->session->userdata('user_id'));

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

    public function save_setting() {
        $data = $this->input->post();
        var_dump($data);

        $shipping_info = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'address2' => $data['address2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'user_id' => $this->session->userdata('user_id')
        );

        $billing_info = array(
            'first_name' => $data['bill_first_name'],
            'last_name' => $data['bill_last_name'],
            'address' => $data['bill_address'],
            'address2' => $data['bill_address2'],
            'city' => $data['bill_city'],
            'state' => $data['bill_state'],
            'zip_code' => $data['bill_zip_code'],
            'user_id' => $this->session->userdata('user_id')
        );

        $this->customer->save_shipping_info($shipping_info);
        $this->customer->save_billing_info($billing_info);

        $this->session->set_flashdata('settings_save', 'Shipping and Billing Infos saved');

        redirect('customers/setting');
        
    }

    public function handlePayment()
    {
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
     
        \Stripe\Charge::create ([
                "amount" => 100 * 120,
                "currency" => "inr",
                "source" => $this->input->post('stripeToken'),
                "description" => "Dummy stripe payment." 
        ]);

        $info = $this->input->post();
        
        $data = array(
            'total_price' => $info['total_price'],
            'order_info' => $info['hidden_json'],
            'user_id' => $this->session->userdata('user_id')
        );

        $this->customer->save_order($data);
        $this->customer->delete_user_temp_orders($this->session->userdata('user_id'));
            
        $this->session->set_flashdata('success', 'Payment has been successful.');
             
        redirect('customers/cart', 'refresh');
    }

}







?>