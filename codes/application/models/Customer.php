<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Model {

    public function fetch_all_categories() {
        $this->db->select("categories.name as name, count(products.name) as count")
        ->join("products", "categories.id = products.category_id")
        ->group_by("products.category_id");
        $query = $this->db->get('categories')->result_array();
        return $query;
    }

    public function get_all_products() {
        $this->db->select('products.id as id, name, description, price, inventory_count, quantity_sold, filename')
            ->from('products')
            ->join('images', 'images.product_id = products.id')
            ->group_by('images.product_id');
            // ->limit($rowperpage, $rowno);  
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function product_detail($id) {
                // $this->output->enable_profiler(TRUE);
        $this->db->where('id', $id);
        $query = $this->db->get('products')->result_array();
        return $query[0];
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



}


?>