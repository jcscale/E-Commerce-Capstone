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


       /*  DOCU: This is the default page for the customers
        Owner: JC
    */
    public function index() {

        $search_text = '';
        if(!empty($this->input->post('search_word'))) {
            $search_text = $this->input->post('search_word');
        }

        $config = array();
        $config["base_url"] = base_url() . "customers/index";
        $config["total_rows"] = $this->customer->get_count($search_text);
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        

        /*
      start 
      add boostrap class and styles
    */
        $config['full_tag_open'] = '<ul class="pagination d-flex justify-content-center mt-3">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close'] = '</span></li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close'] = '</span></li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close'] = '</span></li>';        
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close'] = '</span></li>';        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';
    /*
      end 
      add boostrap class and styles
    */


        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 1;   
        $data["links"] = $this->pagination->create_links();

        $data['products'] = $this->customer->get_all_products($config["per_page"], $config["per_page"]*($page-1), $search_text);
        $data['categories'] = $this->customer->fetch_all_categories();
        $data['page'] = $page;

        if(!empty($this->customer->count_user_temp_order($this->session->userdata('user_id')))) {
            $data['user_temp_orders'] = $this->customer->count_user_temp_order($this->session->userdata('user_id'));
            $this->session->set_userdata('user_temp_orders', $data['user_temp_orders']);
        }
    
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/customer', $data);
        $this->load->view('templates/footer');
    }


   /*  DOCU: This function will retrieve all the categories and display it in the page
        Owner: JC
    */
    public function category($category_id) {

        $search_text = '';
            if(!empty($this->input->post('search_word'))) {
                $search_text = $this->input->post('search_word');
                // var_dump($search_text);
            }
            
        $config = array();
        $config["base_url"] = base_url() . "customers/category/$category_id";
        $config["total_rows"] = $this->customer->category_count($category_id, $search_text);
        $config["per_page"] = 12;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;
        
        /*
        start 
        add boostrap class and styles
        */
        $config['full_tag_open'] = '<ul class="pagination d-flex justify-content-center mt-3">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';        
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close'] = '</span></li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close'] = '</span></li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close'] = '</span></li>';        
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close'] = '</span></li>';        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';
        /*
        end 
        add boostrap class and styles
        */

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4))? $this->uri->segment(4) : 1;   
        $data["links"] = $this->pagination->create_links();       

        $data['categories'] = $this->customer->fetch_all_categories();


        $data['products'] = $this->customer->filter_by_category($category_id, $config["per_page"], $config["per_page"]*($page-1), $search_text);
        $data['page'] = $page;

        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/category', $data);
        $this->load->view('templates/footer');
    }



   /*  DOCU: This function displays the user's shipping and billing information and 
   allows the user to create or update info
        Owner: JC
    */
    public function setting() {

        $data['shipping'] = $this->customer->get_shipping_info($this->session->userdata('user_id'));
        $data['billing'] = $this->customer->get_billing_info($this->session->userdata('user_id'));
        
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/setting', $data);
        $this->load->view('templates/footer');
    }

       /*  DOCU: This function will update the user's shipping and billing info
        Owner: JC
    */
    public function update_setting() {
        $data = $this->input->post();
        
        $shipping_info = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'address2' => $data['address2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code']
        );

        $billing_info = array(
            'first_name' => $data['bill_first_name'],
            'last_name' => $data['bill_last_name'],
            'address' => $data['bill_address'],
            'address2' => $data['bill_address2'],
            'city' => $data['bill_city'],
            'state' => $data['bill_state'],
            'zip_code' => $data['bill_zip_code']
        );

        $this->customer->update_shipping_info($this->session->userdata('user_id'), $shipping_info);
        $this->customer->update_billing_info($this->session->userdata('user_id'), $billing_info);

        $this->session->set_flashdata('update_success', 'Update Success');

        redirect('customers/setting');
        
    }


   /*  DOCU: This function will show the details of a certain product
        Owner: JC
    */
    public function show($id) {
        $data['product'] = $this->customer->product_detail($id);
        $data['images'] = $this->customer->fetch_images($id);
        $data['similar_items'] = $this->customer->similar_items($id, $data['product']['category_id']);

        if(!empty($this->customer->count_user_temp_order($this->session->userdata('user_id')))) {
            $data['user_temp_orders'] = $this->customer->count_user_temp_order($this->session->userdata('user_id'));
            $this->session->set_userdata('user_temp_orders', $data['user_temp_orders']);
        }
        // var_dump($data);
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/product_detail', $data);
        $this->load->view('templates/footer');

    }

       /*  DOCU: This function displays the products that the user wants to buy
        Owner: JC
    */
    public function cart() {
        $data['temp_orders'] = $this->customer->get_user_temp_orders();
        $data['total_temp_price'] = $this->customer->get_total_temp_order_price($this->session->userdata('user_id'));
        $data['shipping'] = $this->customer->get_shipping_info($this->session->userdata('user_id'));
        $data['billing'] = $this->customer->get_billing_info($this->session->userdata('user_id'));

        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/cart', $data);
        $this->load->view('templates/footer');
    }

       /*  DOCU: This function will trigger if the user and will store temporarily the products
       which the user wants to buy
        Owner: JC
    */
    public function temp_orders () {
        $cart = $this->input->post();
        $id = $this->customer->product_detail($cart['product_id']);

        // echo($this->session->userdata('user_id'));

        $temp_order = array(
            'product_id' => $id['id'],
            'name' => $id['name'],
            'price' => $id['price'],
            'quantity' => $cart['quantity'],
            'total_price' =>$cart['quantity'] * $id['price'],
            'users_id' => $this->session->userdata('user_id'),
        );

        $this->session->set_flashdata('order_success', 'Order successfully added to cart.');
        $this->customer->insert_to_temp_order($temp_order);
        redirect('customers/show/'.$id['id']);
    }

       /*  DOCU: This function will delete the selected product in the cart
        Owner: JC
    */
    public function delete_temp_order($id) {
        $this->customer->delete_temp_order($id);
        redirect('customers/cart');
    }

       /*  DOCU: This function will save the infos 
        Owner: JC
    */
    public function save_setting() {
        $data = $this->input->post();
        // var_dump($data);

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

       /*  DOCU: This function uses stripe api and will trigger if the user will checkout the items
        Owner: JC
    */
    public function handlePayment()
    {
        $info = $this->input->post();
        
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
     
        \Stripe\Charge::create ([
                "amount" => 100 * (int)$info['total_price'],
                "currency" => "inr",
                "source" => $this->input->post('stripeToken'),
                "description" => "Dummy stripe payment." 
        ]);

        
        
        $data = array(
            'total_price' => $info['total_price'],
            'order_info' => $info['hidden_json'],
            'user_id' => $this->session->userdata('user_id'),
            'order_status_id' => 3
        );

        $this->customer->save_order($data);
        $this->customer->delete_user_temp_orders($this->session->userdata('user_id'));
        $this->session->unset_userdata('user_temp_orders');
            
        $this->session->set_flashdata('success', 'Payment has been successful.');
             
        redirect('customers/cart', 'refresh');
    }

   /*  DOCU: This function will show the order history of the user
        Owner: JC
    */
    public function order() {
        $data['orders'] = $this->customer->get_customer_orders($this->session->userdata('user_id'));

        $i=0;
        $data2 = [];
        if(!empty($data['orders'])) {
            foreach(json_decode($data['orders'][$i]['order_info'], true) as $order) {
                $data2[] = $order;
            }
        }

        
        $data['customer_items'] = $data2;
        $this->load->view('templates/header');
        $this->load->view('templates/customer_nav');
        $this->load->view('customer/order', $data);
        $this->load->view('templates/footer');
    }

}







?>