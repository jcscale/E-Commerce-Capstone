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

    // public function loadData($record=0) {
	// 	$recordPerPage = 3;
	// 	if($record != 0){
	// 	    	$record = ($record-1) * $recordPerPage;
	// 	}      	
    //   	$recordCount = $this->dashboard->get_count();
    //   	$empRecord = $this->dashboard->fetch_all_products($record,$recordPerPage);
    //   	$config['base_url'] = base_url() . "dashboards/loadData";
    //   	$config['use_page_numbers'] = TRUE;
        
	// 	// $config['next_link'] = '<i class="pagi-next" style="border:1px solid blue; padding: 3px; text-decoration:none;">Next</i>';
	// 	// $config['prev_link'] = '<i class="pagi-prev" style="border:1px solid blue; padding: 3px; text-decoration:none;">Previous</i>';

        

    //     // $config['num_links'] = 1;
	// 	$config['total_rows'] = $recordCount;
	// 	$config['per_page'] = $recordPerPage;

    //     //Set that how many number of pages you want to view.
    //     $config['num_links'] = $recordCount;

    //     $config['num_tag_open'] = '<div class="digit">';


    //     $config['num_tag_close'] = '</div>';

    //     // Open tag for CURRENT link.
    //     $config['cur_tag_open'] = '&nbsp;<a class="current">';

    //     // Close tag for CURRENT link.
    //     $config['cur_tag_close'] = '</a>';

    //     // By clicking on performing NEXT pagination.
    //     $config['next_link'] = 'Next';

    //     // By clicking on performing PREVIOUS pagination.
    //     $config['prev_link'] = 'Previous';

	// 	$this->pagination->initialize($config);
	// 	$data['pagination'] = $this->pagination->create_links();
	// 	$data['products'] = $empRecord;
    //     $data['categories'] = $this->dashboard->fetch_all_categories();
    //     return $this->load->view('partials/dashboard_products', $data);
    //     // return $data;
	// }

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

    public function add_product() {
        $product = $this->input->post();

        $data = array(
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'inventory_count' => $product['inventory_count'],
            'quantity_sold' => $product['quantity_sold'],
            'category_id' => $product['category_id']
        );  
     
        $count = count($_FILES['files']['name']);  

        for($i=0;$i<$count;$i++){  
      
            if(!empty($_FILES['files']['name'][$i])){  
          
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];  
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];  
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];  
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];  
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];  
            
                $config['upload_path'] = 'uploads/';   
                $config['allowed_types'] = 'jpg|jpeg|png|gif';  
                $config['max_size'] = '5000';  
                $config['file_name'] = $_FILES['files']['name'][$i];  
            
                $this->load->library('upload',$config);   
            
                if($this->upload->do_upload('image')){  
                    $uploadData = $this->upload->data();  
                    $filename = $uploadData['file_name'];  

                    
            
                    $data['totalFiles'][] = $filename;  
                }  
                else {
                    print_r($this->upload->display_errors());
                }
            }  
         
        }  

        $this->dashboard->add_product($data);
        $id = $this->dashboard->get_product_by_name($data['name']);

        $file_data = array(
            'filename' => $data['totalFiles'],
            'product_id' => $id['id']
        );

        $this->dashboard->product_image($file_data);

        redirect('products');




        // $config['allowed_types'] = 'png|jpg|jpeg';
        // $config['upload_path'] = './uploads/';
        // $this->load->library('upload', $config);

        // $product = $this->input->post();
        // // var_dump($product);
        // if($this->upload->do_upload('image')) {
        //     $filename = $this->upload->data();

        //     $data = array(
        //         'name' => $product['name'],
        //         'description' => $product['description'],
        //         'price' => $product['price'],
        //         'inventory_count' => $product['inventory_count'],
        //         'quantity_sold' => $product['quantity_sold'],
        //         'category_id' => $product['category_id']
        //     );

        //     $this->dashboard->add_product($data);
        //     $id = $this->dashboard->get_product_by_name($data['name']);
            
        //     $file_data = array(
        //         'filename' => $filename['file_name'],
        //         'product_id' => $id['id']
        //     );

        //     $this->dashboard->product_image($file_data);

        //     redirect('products');
        // }
        // else {
        //     print_r($this->upload->display_errors());
        // }
    }



    public function delete_product($id) {
        $this->dashboard->delete_product($id);
        redirect('products');
    }

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

            redirect('products');
        }
        else {
            print_r($this->upload->display_errors());
        }
           
    }

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