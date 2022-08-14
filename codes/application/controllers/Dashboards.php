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

    public function loadData($record=0) {
		$recordPerPage = 3;
		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}      	
      	$recordCount = $this->dashboard->get_count();
      	$empRecord = $this->dashboard->fetch_all_products($record,$recordPerPage);
      	$config['base_url'] = base_url() . "dashboards/loadData";
      	$config['use_page_numbers'] = TRUE;
        
		// $config['next_link'] = '<i class="pagi-next" style="border:1px solid blue; padding: 3px; text-decoration:none;">Next</i>';
		// $config['prev_link'] = '<i class="pagi-prev" style="border:1px solid blue; padding: 3px; text-decoration:none;">Previous</i>';

        

        // $config['num_links'] = 1;
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;

        //Set that how many number of pages you want to view.
        $config['num_links'] = $recordCount;

        $config['num_tag_open'] = '<div class="digit">';


        $config['num_tag_close'] = '</div>';

        // Open tag for CURRENT link.
        $config['cur_tag_open'] = '&nbsp;<a class="current">';

        // Close tag for CURRENT link.
        $config['cur_tag_close'] = '</a>';

        // By clicking on performing NEXT pagination.
        $config['next_link'] = 'Next';

        // By clicking on performing PREVIOUS pagination.
        $config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['products'] = $empRecord;
        return $this->load->view('partials/dashboard_products', $data);
	}

     /*  DOCU: This function is triggered by default if the user is an admin.
        Owner: JC
    */
    public function index() {
        

        $this->load->view('templates/header.php');
        $this->load->view('templates/admin_navbar.php');
        $this->load->view('dashboards/dashboard');
        $this->load->view('templates/footer.php');
    }

     /*  DOCU: This function will display all the products where the admin can
        perform crud activities.
        Owner: JC
    */
    public function products() {
        $data['categories'] = $this->dashboard->fetch_all_categories();
        // $data['products'] = $this->dashboard->fetch_all_products();
        
        $this->load->view('templates/header.php');
        $this->load->view('templates/admin_navbar.php');
        $this->load->view('dashboards/dashboard_products', $data);
        $this->load->view('templates/footer.php');
        
    }

    public function index_html() {

        $this->loadData();
    }

    public function add_product() {
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['upload_path'] = './uploads/';
        // $config['max_size'] = 100;
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768;
        $this->load->library('upload', $config);

        $product = $this->input->post();

        if($this->upload->do_upload('image')) {
            $filename = $this->upload->data();

            $data = array(
                'name' => $product['name'],
                'description' => $product['description'],
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

            redirect('products');
        }
        else {
            print_r($this->upload->display_errors());
        }
    }

    public function delete_product($id) {
        $this->dashboard->delete_product($id);
        redirect('products');
    }
}


?>