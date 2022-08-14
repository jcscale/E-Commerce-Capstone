<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

    public function fetch_all_categories() {
        return $this->db->get('categories')->result_array();
    }

    public function fetch_all_products() {
        // $this->output->enable_profiler(TRUE);
        $this->db->select('*')
            ->from('products')
            ->join('images', 'images.product_id = products.id');
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
        $this->db->join('images', 'images.product_id = products.id')
            ->where('products.id', $id);
        $query = $this->db->get('products')->result_array();
        return $query[0];
    }

    public function update_product($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('products', $data);
        return $query;
    }
}









?>