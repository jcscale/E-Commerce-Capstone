<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Model {

    public function fetch_all_categories() {
        $this->db->select("categories.id, categories.name as name, count(products.name) as count")
        ->join("products", "categories.id = products.category_id")
        ->group_by("products.category_id");
        $query = $this->db->get('categories')->result_array();
        return $query;
    }

    public function get_all_products($limit, $start, $search="") {
        // $this->output->enable_profiler(TRUE);
        $this->db->select('products.id as id, name, description, price, inventory_count, quantity_sold, filename');
        $this->db->from('products');

        if($search != '') {
            $this->db->like('name', $search);
            $this->db->or_like('price', $search);
        }

        $this->db->join('images', 'images.product_id = products.id')
        ->group_by('images.product_id')
        ->limit($limit, $start);  
        $query = $this->db->get()->result_array();
        return $query;
           
    }

    public function get_count($search='') {
        $this->db->select('count(*) as all_records');
        $this->db->from('products');

        if($search != '') {
            $this->db->like('name', $search);
            $this->db->or_like('price', $search);
        }

        // return $this->db->count_all('products');
        $query = $this->db->get()->result_array();
        // var_dump($query);
        return $query[0]['all_records'];
    }

    public function category_count($category_id, $search="") {
        // $this->output->enable_profiler(TRUE);
        $this->db->where('category_id', $category_id);
        $this->db->from('products');

        if($search != '') {
            $this->db->like('name', $search);
            $this->db->or_like('price', $search);
        }

        return $this->db->count_all_results();
    }

    public function filter_by_category($category_id, $limit, $start, $search="") {
        if((int)$category_id > 0) {
            $this->db->select('products.id as id, products.name as name, description, price, inventory_count, quantity_sold, filename, categories.name as cate_name')
            ->from('products')
            ->join('images', 'images.product_id = products.id')
            ->join('categories', 'products.category_id = categories.id');

            if($search != '') {
                $this->db->like('products.name', $search);
                $this->db->or_like('price', $search);
            }

            $this->db->where('category_id', $category_id)
            ->group_by('images.product_id')
            ->limit($limit, $start);  
            $query = $this->db->get()->result_array();
            return $query;
        }
    }

    public function search_product($search) {
        $query = $this->db->select('*')
        ->from('products')
        ->join('images', 'images.product_id = products.id')
        ->like('name', $search)->get();


        if($query->num_rows()>0) {
            return $query->result_array();
        }
        else {
            return null;
        }
    }

    public function product_detail($id) {
                // $this->output->enable_profiler(TRUE);
        $this->db->where('id', $id);
        $query = $this->db->get('products')->result_array();
        return $query[0];
    }

    public function similar_items($id, $category_id) {
        $this->db->select("*")
        ->join('images', 'images.product_id = products.id')
        ->join('categories', 'categories.id = products.category_id')
        ->where('products.id !=', $id)
        ->where('category_id', $category_id);
        $query = $this->db->get("products")->result_array();
        return $query;
    }

    public function fetch_images($product_id) {
        $query = $this->db->where('product_id', $product_id)->get('images')->result_array();
        return $query;
    }   

    public function insert_to_temp_order($data) {
        $query = $this->db->insert('temp_orders', $data);
        return $query;
    }

    public function get_user_temp_orders() {
        // $this->output->enable_profiler(TRUE);
        $this->db->select("id, product_id, name, price, sum(quantity) as quantity, sum(total_price) as total_price");
        $this->db->where('users_id', $this->session->userdata('user_id'));
        $this->db->group_by('name, users_id');
        $query = $this->db->get('temp_orders')->result_array();
        return $query;
    }

    public function get_total_temp_order_price() {
        $this->db->select("sum(total_price) as total_temp_price")
        ->group_by('users_id');
        $query = $this->db->get('temp_orders')->result_array();
        if(!empty($query)){
            return $query[0];
        }
    }

    public function count_user_temp_order() {
        $this->db->where('id', $this->session->userdata('user_id'));
        $query = $this->db->count_all('temp_orders');
        if(!empty($query)) {
            return $query;
        }
    }

    public function delete_temp_order($id) {
        $this->db->where('id', $id);
        $query = $this->db->delete('temp_orders');
        return $query;
    }

    public function delete_user_temp_orders($id) {
        $this->db->where('users_id', $id);
        $query = $this->db->delete('temp_orders');
        return $query;
    }

    public function save_shipping_info($shipping) {
        $query = $this->db->insert('shipping_infos', $shipping);
        return $query;
    }

    public function save_billing_info($billing) {
        $query = $this->db->insert('billing_infos', $billing);
        return $query;
    }


    public function update_shipping_info($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->update('shipping_infos', $data);
        return $query;
    }

    public function update_billing_info($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->update('billing_infos', $data);
        return $query;
    }

    public function get_shipping_info($id) {
        $query = $this->db->where('user_id', $id)->get('shipping_infos')->result_array();
        return $query[0];
    }

    public function get_billing_info($id) {
        $query = $this->db->where('user_id', $id)->get('billing_infos')->result_array();
        return $query[0];
    }

    public function save_order($data) {
        $query = $this->db->insert('orders', $data);
        return $query;
    }


    public function get_customer_orders($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('orders')->result_array();
        return $query;
    }

}


?>