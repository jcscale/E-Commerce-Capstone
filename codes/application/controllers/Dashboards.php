<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboards extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("pagination");
        if(!$this->session->userdata('user_id')) {
            redirect("/");
        }
    }

     /*  DOCU: This function is triggered by default if the user is an admin.
        Owner: JC
    */
    public function index() {
        $data['orders'] = $this->dashboard->fetch_all_orders();
        // var_dump($data);
        $this->load->view('templates/header.php');
        $this->load->view('templates/admin_navbar.php');
        $this->load->view('dashboards/dashboard', $data);
        $this->load->view('templates/footer.php');
    }

     /*  DOCU: This function will display all the products where the admin can
        perform crud activities.
        Owner: JC
    */
    public function products() {
        $data['categories'] = $this->dashboard->fetch_all_categories();
        $data['products'] = $this->dashboard->fetch_all_products();


        $data['categories'] = $this->dashboard->fetch_all_categories();
        
        $this->load->view('templates/header.php');
        $this->load->view('templates/admin_navbar.php');
        $this->load->view('dashboards/dashboard_products', $data);
        $this->load->view('templates/footer.php');
        
    }

     /*  DOCU: This function is used to add product to the database
        Owner: JC
    */
    public function add_product() {

        $config['allowed_types'] = 'png|jpg|jpeg|webp';
        $config['upload_path'] = './uploads/';
        $this->load->library('upload', $config);

        $product = $this->input->post();
        // var_dump($product);
        if($this->upload->do_upload('image')) {
            $filename = $this->upload->data();

            $data = array(
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'inventory_count' => $product['inventory_count'],
                'quantity_sold' => $product['quantity_sold'],
                'category_id' => $product['category_id']
            );

            $this->dashboard->add_product($data);
            $id = $this->dashboard->get_product_by_name($data['name']);
            
            $file_data = array(
                'filename' => $filename['file_name'],
                'product_id' => $id['id']
            );

            $this->dashboard->product_image($file_data);

            $this->session->set_flashdata('product_added', 'Product added');

            redirect('products');
        }
        else {
            print_r($this->upload->display_errors());
        }
    }

    public function add_category() {
        $category_name = $this->input->post('category');
        var_dump($category_name);
        $data = array(
            'name' =>$category_name
        );
        $this->dashboard->add_category($data);
        redirect('dashboards/products');
    }


     /*  DOCU: This function will delete the selected product
        Owner: JC
    */
    public function delete_product($id) {
        $this->dashboard->delete_product($id);
        $this->session->set_flashdata('product_deleted', 'Product deleted');
        redirect('products');
    }

       /*  DOCU: This function will retrieve the product and its details base on the id
        Owner: JC
    */
    public function product_detail($id) {
        $result_data = $this->dashboard->get_product_by_id($id);
        $product_id = $result_data['id'];
        // $result['images'] = $this->dashboard->fetch_images($product_id);

        $result = array(
            'res' => $this->dashboard->get_product_by_id($id),
            'images' => $this->dashboard->fetch_images($product_id)
        );

        // header('Content-Type: application/json');
        echo json_encode($result);
        // redirect('products');
    }

       /*  DOCU: This function will will update the product base on the id
        Owner: JC
    */
    public function update_product() {
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['upload_path'] = './uploads/';
        $this->load->library('upload', $config);

        if($this->upload->do_upload('edit_image')) {

            $filename = $this->upload->data();
            $result = $this->input->post();

            $data = array(
                'name' => $result['edit_name'],
                'description' => $result['edit_description'],
                'price' => $result['edit_price'],
                'inventory_count' => $result['edit_inventory_count'],
                'quantity_sold' => $result['edit_quantity_sold'],
                'category_id' => $result['category_id']
            );
            $id = $result['edit_id'];

            $file_data = array(
                'filename' => $filename['file_name'],
                'product_id' => $id
            );

            $this->dashboard->product_image($file_data);
    
            $this->dashboard->update_product($id, $data);

            $this->session->set_flashdata('product_updated', 'Product updated');

            redirect('products');
        }
        else {
            print_r($this->upload->display_errors());
        }
           
    }

       /*  DOCU: This function will show the details of the orders in the page
        Owner: JC
    */
    public function show($id) {
        $data['info'] = $this->dashboard->get_order_by_id($id);
        // var_dump($data['info']);
        $json_data = json_decode($data['info']['order_info'], true);
        // var_dump($json_data); 
        $data['json_orders'] = $json_data;

        $this->load->view('templates/header.php');
        $this->load->view('templates/admin_navbar.php');
        $this->load->view('dashboards/order_details', $data);
        $this->load->view('templates/footer.php');
    }
}


?>