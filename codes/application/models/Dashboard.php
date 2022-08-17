<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

    public function fetch_all_categories() {
        return $this->db->get('categories')->result_array();
    }

    public function fetch_all_products() {
        // $this->output->enable_profiler(TRUE);
        $this->db->select('products.id as id, name, description, inventory_count, quantity_sold, filename')
            ->from('products')
            ->join('images', 'images.product_id = products.id')
            ->group_by('images.product_id');
            // ->limit($rowperpage, $rowno);  
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_count() {
        return $this->db->count_all('products');
    }

    public function get_product_by_name($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('products')->result_array();
        return $query[0];
    }

    public function add_product($product) {
        $query = $this->db->insert('products', $product);
        return $query;
    }

    public function product_image($filename) {
        $query = $this->db->insert('images', $filename);
        return $query;
    }

    public function delete_product($id) {
        // $this->output->enable_profiler(TRUE);
        $this->db->where('id', $id);
        $query = $this->db->delete('products');
        return $query;
    }

    public function get_product_by_id($id) {
        // $this->output->enable_profiler(TRUE);
        $this->db->select('products.id as id, name, description, price, inventory_count, quantity_sold, filename')
            ->from('products')
            ->join('images', 'images.product_id = products.id')
            ->where('products.id', $id);
        $query = $this->db->get()->result_array();
        return $query[0];
    }

    public function update_product($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('products', $data);
        return $query;
    }

    public function fetch_images($product_id) {
        $query = $this->db->where('product_id', $product_id)->get('images')->result_array();
        return $query;
    }

    public function fetch_all_orders() {
        $this->db->select('orders.id, orders.total_price, date(orders.created_at) as created_at, users.first_name, billing_infos.address')
        ->join('users', 'users.id = orders.user_id')
        ->join('billing_infos', 'users.id = billing_infos.user_id')
        ->join('shipping_infos', 'users.id = shipping_infos.user_id')
        ->group_by('id');
        $query = $this->db->get('orders')->result_array();
        return $query;
    }

    public function get_order_by_id($id) {
        $this->db->select("orders.id, orders.order_info, orders.total_price, 
                        shipping_infos.first_name, shipping_infos.address, shipping_infos.city, shipping_infos.state, shipping_infos.zip_code,
                        billing_infos.first_name as 'bill_first_name', billing_infos.address as 'bill_address', billing_infos.city as 'bill_city',
                        billing_infos.state as 'bill_state', billing_infos.zip_code as 'bill_zip' ")
        ->join('users', 'users.id = orders.user_id')
        ->join('billing_infos', 'users.id = billing_infos.user_id')
        ->join('shipping_infos', 'users.id = shipping_infos.user_id')
        ->where('orders.id', $id);
        $query = $this->db->get('orders')->result_array();
        return $query[0];

    }
}









?>